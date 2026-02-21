#!/usr/bin/env python3
"""Retry downloading image URLs found in the backup, with normalization and filtering.

Outputs:
 - updates images_map.json in the backup folder
 - writes failed_urls.json with URLs that couldn't be downloaded
"""
import os
import re
import json
import time
import ssl
from urllib.parse import urlparse, unquote
from urllib.request import urlopen

BACKUP_DIR = "/Users/ericklopez/Library/Mobile Documents/com~apple~CloudDocs/Code/ucondieresis-backup/ucondieresis.com"
UPLOADS_DIR = os.path.join(BACKUP_DIR, "uploads")
IMAGES_MAP = os.path.join(BACKUP_DIR, "images_map.json")
FAILED_JSON = os.path.join(BACKUP_DIR, "failed_images.json")


def ensure_dir(p):
    os.makedirs(p, exist_ok=True)


def scan_html_for_urls():
    urls = set()
    pattern_src = re.compile(r'src=["\'](https?://[^"\']+)["\']', re.I)
    pattern_og = re.compile(r'<meta[^>]+property=["\']og:image["\'][^>]*content=["\'](https?://[^"\']+)["\']', re.I)
    pattern_meta = re.compile(r'<meta[^>]+content=["\'](https?://[^"\']+\.(?:jpg|jpeg|png|gif|webp))["\']', re.I)
    for root, _, files in os.walk(BACKUP_DIR):
        for fn in files:
            if fn.lower().endswith(('.html', '.htm')):
                path = os.path.join(root, fn)
                try:
                    with open(path, 'r', encoding='utf-8', errors='ignore') as fh:
                        html = fh.read()
                except Exception:
                    continue
                for m in pattern_src.findall(html):
                    urls.add(m.strip())
                for m in pattern_og.findall(html):
                    urls.add(m.strip())
                for m in pattern_meta.findall(html):
                    urls.add(m.strip())
    return sorted(urls)


def normalize_url(u):
    if not u:
        return u
    # strip wrapping quotes and whitespace
    u = u.strip().strip('"').strip("'")
    # remove trailing ) or ;
    u = u.rstrip(');')
    # decode percent-encodings
    u = unquote(u)
    return u


def is_image_url(u):
    low = u.lower()
    if any(low.endswith(ext) for ext in ('.jpg', '.jpeg', '.png', '.gif', '.webp')):
        return True
    # heuristic: contains typical image path segments
    if '/fb_' in low or '/logo' in low or 'blob-' in low:
        return True
    return False


def filename_from_url(u, used):
    p = urlparse(u)
    name = os.path.basename(p.path)
    if not name:
        name = 'image'
    name = unquote(name.split('?')[0])
    base, ext = os.path.splitext(name)
    if not ext:
        ext = '.jpg'
    name = base + ext
    # ensure unique
    orig = name
    i = 1
    while name in used:
        name = f"{base}_{i}{ext}"
        i += 1
    used.add(name)
    return name


def try_download(u, local_path, ctx, tries=2):
    last_err = None
    for attempt in range(1, tries+1):
        try:
            with urlopen(u, context=ctx, timeout=30) as r:
                data = r.read()
            with open(local_path, 'wb') as out:
                out.write(data)
            return True, None
        except Exception as e:
            last_err = e
            time.sleep(0.5)
    return False, str(last_err)


def main():
    ensure_dir(UPLOADS_DIR)
    urls = scan_html_for_urls()
    if not urls:
        print('No URLs found to retry.')
        return
    print(f'Found {len(urls)} candidate URLs (before filtering).')

    # load existing mapping
    existing = {}
    if os.path.exists(IMAGES_MAP):
        try:
            with open(IMAGES_MAP, 'r', encoding='utf-8') as jf:
                existing = json.load(jf)
        except Exception:
            existing = {}

    ctx = ssl.create_default_context()
    ctx.check_hostname = False
    ctx.verify_mode = ssl.CERT_NONE

    used_names = set(os.listdir(UPLOADS_DIR))
    mapping = dict(existing)
    failed = {}

    for raw in urls:
        u = normalize_url(raw)
        if not is_image_url(u):
            continue
        if u in mapping:
            continue
        name = filename_from_url(u, used_names)
        local_path = os.path.join(UPLOADS_DIR, name)
        print(f'Downloading {u} -> {local_path}')
        ok, err = try_download(u, local_path, ctx, tries=3)
        if ok:
            mapping[u] = os.path.relpath(local_path, BACKUP_DIR)
        else:
            failed[u] = err

    with open(IMAGES_MAP, 'w', encoding='utf-8') as jf:
        json.dump(mapping, jf, indent=2, ensure_ascii=False)
    with open(FAILED_JSON, 'w', encoding='utf-8') as jf:
        json.dump(failed, jf, indent=2, ensure_ascii=False)

    print(f'Downloaded {len(mapping)-len(existing)} new images, {len(failed)} failures.')
    print(f'Images map: {IMAGES_MAP}')
    print(f'Failed list: {FAILED_JSON}')


if __name__ == '__main__':
    main()
