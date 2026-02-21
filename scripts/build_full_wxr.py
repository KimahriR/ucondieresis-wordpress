#!/usr/bin/env python3
"""Build a full WXR including specified pages and attachment items.

Writes: /Users/ericklopez/ucondieresis-backup/ucondieresis-wxr-full.xml
"""
import os
import re
import json
from datetime import datetime

BACKUP_DIR = "/Users/ericklopez/Library/Mobile Documents/com~apple~CloudDocs/Code/ucondieresis-backup/ucondieresis.com"
OUT_WXR = os.path.join(BACKUP_DIR, "ucondieresis-wxr-full.xml")
IMAGES_MAP = os.path.join(BACKUP_DIR, "images_map.json")
SITE_URL = "https://ucondieresis.com"

PAGE_FILES = {
    "index.html": "",
    "nosotros.html": "nosotros",
    "catálogos-1.html": "catálogos-1",
    "galería.html": "galería",
    "contacto.html": "contacto",
    "aviso-de-privacidad.html": "aviso-de-privacidad",
}


def read_file(path):
    with open(path, 'r', encoding='utf-8', errors='ignore') as f:
        return f.read()


def extract_title(html):
    m = re.search(r'<title[^>]*>(.*?)</title>', html, re.I | re.S)
    if m:
        return m.group(1).strip()
    return None


def extract_body(html):
    m = re.search(r'<body[^>]*>(.*?)</body>', html, re.I | re.S)
    if m:
        return m.group(1).strip()
    # fallback: return whole html
    return html.strip()


def slug_from_name(name):
    return name.replace('index.html', '').replace('.html', '').strip('/')


def make_page_item(title, slug, content, filename, post_id):
    now = datetime.utcnow().strftime('%Y-%m-%d %H:%M:%S')
    link = SITE_URL + ('/' + slug if slug else '/')
    post_name = slug or 'home'
    item = '<item>\n'
    item += f'<title>{title}</title>\n'
    item += f'<link>{link}</link>\n'
    item += f'<pubDate>{now}+0000</pubDate>\n'
    item += f'<dc:creator><![CDATA[import]]></dc:creator>\n'
    item += '<guid isPermaLink="false">{}</guid>\n'.format(link)
    item += '<description></description>\n'
    item += '<content:encoded><![CDATA[{}]]></content:encoded>\n'.format(content)
    item += '<excerpt:encoded><![CDATA[]]></excerpt:encoded>\n'
    item += '<wp:post_id>{}</wp:post_id>\n'.format(post_id)
    item += '<wp:post_name>{}</wp:post_name>\n'.format(post_name)
    item += '<wp:post_parent>0</wp:post_parent>\n'
    item += '<wp:menu_order>0</wp:menu_order>\n'
    item += '<wp:post_type>page</wp:post_type>\n'
    item += '<wp:post_password></wp:post_password>\n'
    item += '<wp:status>publish</wp:status>\n'
    item += '<wp:post_date_gmt>{}</wp:post_date_gmt>\n'.format(now)
    item += '<wp:post_date>{}</wp:post_date>\n'.format(now)
    item += '<wp:post_modified>{}</wp:post_modified>\n'.format(now)
    item += '<wp:post_modified_gmt>{}</wp:post_modified_gmt>\n'.format(now)
    item += '<wp:comment_status>closed</wp:comment_status>\n'
    item += '<wp:ping_status>closed</wp:ping_status>\n'
    item += '<wp:is_sticky>0</wp:is_sticky>\n'
    item += '</item>\n'
    return item


def make_attachment_item(url, relpath):
    filename = os.path.basename(relpath)
    item = '<item>\n'
    item += f'<title>{filename}</title>\n'
    item += f'<link>{url}</link>\n'
    item += '<wp:post_type>attachment</wp:post_type>\n'
    item += f'<wp:attachment_url>{relpath}</wp:attachment_url>\n'
    item += '</item>\n'
    return item


def build():
    header = '<?xml version="1.0" encoding="UTF-8"?>\n'
    header += '<rss version="2.0" xmlns:excerpt="http://wordpress.org/export/1.2/excerpt/" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:wfw="http://wellformedweb.org/CommentAPI/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:wp="http://wordpress.org/export/1.2/">\n'
    header += '<channel>\n'
    header += f'<title>Ü con Diéresis</title>\n'
    header += f'<link>{SITE_URL}</link>\n'
    header += '<language>es-mx</language>\n'
    items = []
    post_id = 1

    # Pages
    for fname, slug in PAGE_FILES.items():
        fpath = os.path.join(BACKUP_DIR, fname)
        if os.path.exists(fpath):
            html = read_file(fpath)
            title = extract_title(html) or fname
            body = extract_body(html)
            items.append(make_page_item(title, slug, body, fname, post_id))
            post_id += 1

    # Attachments from images_map.json if exists
    if os.path.exists(IMAGES_MAP):
        try:
            with open(IMAGES_MAP, 'r', encoding='utf-8') as jf:
                mapping = json.load(jf)
            for url, relpath in mapping.items():
                items.append(make_attachment_item(url, relpath))
        except Exception:
            pass

    footer = '</channel>\n</rss>\n'

    with open(OUT_WXR, 'w', encoding='utf-8') as out:
        out.write(header)
        for it in items:
            out.write(it)
        out.write(footer)

    print(f'WXR written to: {OUT_WXR} (pages: {len([i for i in items if "page" in i])}, attachments: {len([i for i in items if "attachment" in i])})')


if __name__ == '__main__':
    build()
