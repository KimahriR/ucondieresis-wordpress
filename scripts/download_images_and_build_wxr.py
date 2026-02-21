#!/usr/bin/env python3
"""Download images from static backup and generate a partial WXR with attachments.

Usage: python3 scripts/download_images_and_build_wxr.py
"""
import os
import re
import sys
import json
import errno
from urllib.parse import urlparse, unquote
from urllib.request import urlopen
import ssl


BACKUP_DIR = "/Users/ericklopez/Library/Mobile Documents/com~apple~CloudDocs/Code/ucondieresis-backup/ucondieresis.com"
UPLOADS_DIR = os.path.join(BACKUP_DIR, "uploads")
WXR_PATH = os.path.join(BACKUP_DIR, "ucondieresis-wxr.xml")
IMAGES_MAP = os.path.join(BACKUP_DIR, "images_map.json")


def ensure_dir(path):
    try:
        os.makedirs(path, exist_ok=True)
    except OSError as e:
        if e.errno != errno.EEXIST:
            raise


def find_image_urls_in_html(html):
    urls = set()
    # match src="http..." and src='http...'
    for m in re.findall(r'src=["\'](https?://[^"\']+)["\']', html, flags=re.I):
        urls.add(m)
    # match og:image content
    for m in re.findall(r'property=["\']og:image["\'][^>]*content=["\'](https?://[^"\']+)["\']', html, flags=re.I):
        urls.add(m)
    # match meta content= with image url (fallback)
    for m in re.findall(r'<meta[^>]+content=["\'](https?://[^"\']+\.(?:jpg|jpeg|png|gif)["\'])', html, flags=re.I):
        urls.add(m)
    return urls


def sanitize_filename_from_url(url):
    p = urlparse(url)
    name = os.path.basename(p.path)
    name = unquote(name)
    if not name:
        name = "image"
    # remove query params in name
    name = name.split('?')[0]
    # fallback extension
    if not os.path.splitext(name)[1]:
        name = name + ".jpg"
    return name


def download_images(urls, uploads_dir):
    ensure_dir(uploads_dir)
    mapping = {}
    seen = {}
    ctx = ssl.create_default_context()
    # disable certificate verification to avoid macOS cert issues
    ctx.check_hostname = False
    ctx.verify_mode = ssl.CERT_NONE
    for url in sorted(urls):
        fname = sanitize_filename_from_url(url)
        # ensure unique
        base, ext = os.path.splitext(fname)
        counter = seen.get(fname, 0)
        if counter:
            fname = f"{base}_{counter}{ext}"
        seen[fname] = seen.get(fname, 0) + 1
        local_path = os.path.join(uploads_dir, fname)
        try:
            print(f"Downloading: {url} -> {local_path}")
            with urlopen(url, context=ctx, timeout=30) as resp:
                data = resp.read()
            with open(local_path, 'wb') as out:
                out.write(data)
            mapping[url] = os.path.relpath(local_path, BACKUP_DIR)
        except Exception as e:
            print(f"Failed to download {url}: {e}")
    return mapping


def build_partial_wxr(mapping, wxr_path):
    # Minimal WXR structure with attachment items
    header = '<?xml version="1.0" encoding="UTF-8"?>\n'
    header += '<rss version="2.0" xmlns:excerpt="http://wordpress.org/export/1.2/excerpt/" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:wfw="http://wellformedweb.org/CommentAPI/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:wp="http://wordpress.org/export/1.2/">\n'
    header += '<channel>\n'
    header += '<title>Ü con Diéresis - attachments</title>\n'
    footer = '</channel>\n</rss>\n'

    items = []
    for url, relpath in mapping.items():
        filename = os.path.basename(relpath)
        item = '<item>\n'
        item += f'<title>{filename}</title>\n'
        item += f'<link>{url}</link>\n'
        item += '<wp:post_type>attachment</wp:post_type>\n'
        item += f'<wp:attachment_url>uploads/{filename}</wp:attachment_url>\n'
        item += '</item>\n'
        items.append(item)

    with open(wxr_path, 'w', encoding='utf-8') as f:
        f.write(header)
        for it in items:
            f.write(it)
        f.write(footer)


def main():
    if not os.path.isdir(BACKUP_DIR):
        print(f"Backup directory not found: {BACKUP_DIR}")
        sys.exit(1)

    urls = set()
    for root, _, files in os.walk(BACKUP_DIR):
        for fn in files:
            if fn.lower().endswith('.html') or fn.lower().endswith('.htm'):
                path = os.path.join(root, fn)
                try:
                    with open(path, 'r', encoding='utf-8', errors='ignore') as fh:
                        html = fh.read()
                    found = find_image_urls_in_html(html)
                    if found:
                        print(f"Found {len(found)} images in {os.path.relpath(path, BACKUP_DIR)}")
                    urls.update(found)
                except Exception as e:
                    print(f"Failed to read {path}: {e}")

    if not urls:
        print("No image URLs found in HTML backup.")
        sys.exit(0)

    mapping = download_images(urls, UPLOADS_DIR)

    with open(IMAGES_MAP, 'w', encoding='utf-8') as jf:
        json.dump(mapping, jf, indent=2, ensure_ascii=False)

    build_partial_wxr(mapping, WXR_PATH)

    print(f"Downloaded {len(mapping)} images.")
    print(f"Images map: {IMAGES_MAP}")
    print(f"Partial WXR written to: {WXR_PATH}")


if __name__ == '__main__':
    main()
