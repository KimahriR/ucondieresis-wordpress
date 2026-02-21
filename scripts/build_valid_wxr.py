#!/usr/bin/env python3
"""Build a valid WordPress WXR file that can be imported."""
import os
import re
import json
from datetime import datetime

BACKUP_DIR = "/Users/ericklopez/Library/Mobile Documents/com~apple~CloudDocs/Code/ucondieresis-backup/ucondieresis.com"
OUT_WXR = os.path.join(BACKUP_DIR, "ucondieresis-wxr-full.xml")
IMAGES_MAP = os.path.join(BACKUP_DIR, "images_map.json")
SITE_URL = "https://ucondieresis.com"
BLOG_URL = "https://ucondieresis.com"

PAGE_FILES = {
    "index.html": "",
    "nosotros.html": "nosotros",
    "catálogos-1.html": "catalogos-1",
    "galería.html": "galeria",
    "contacto.html": "contacto",
    "aviso-de-privacidad.html": "aviso-de-privacidad",
}


def escape_xml(text):
    """Escape special XML characters"""
    if not text:
        return ""
    text = str(text)
    text = text.replace('&', '&amp;')
    text = text.replace('<', '&lt;')
    text = text.replace('>', '&gt;')
    text = text.replace('"', '&quot;')
    text = text.replace("'", '&apos;')
    return text


def read_file(path):
    try:
        with open(path, 'r', encoding='utf-8', errors='ignore') as f:
            return f.read()
    except:
        return ""


def extract_title(html):
    """Extract title from HTML"""
    m = re.search(r'<title[^>]*>(.*?)</title>', html, re.I | re.S)
    if m:
        title = m.group(1).strip()
        # Clean up title
        title = re.sub(r'[<>]', '', title)
        return title[:200]
    return None


def extract_body(html):
    """Extract body content from HTML"""
    m = re.search(r'<body[^>]*>(.*?)</body>', html, re.I | re.S)
    if m:
        content = m.group(1).strip()
    else:
        content = html.strip()
    
    # Remove script and style tags
    content = re.sub(r'<script[^>]*>.*?</script>', '', content, flags=re.I | re.S)
    content = re.sub(r'<style[^>]*>.*?</style>', '', content, flags=re.I | re.S)
    
    # Keep only main content tags
    return content[:50000]  # Limit size


def make_page_item(title, slug, content, post_id):
    """Create a valid WXR page item"""
    now = "2026-02-21 05:30:00"
    link = SITE_URL + ('/' + slug if slug else '/')
    post_name = slug if slug else 'home'
    
    # Escape content for CDATA
    content_escaped = content.replace(']]>', ']]&gt;')
    
    item = f"""	<item>
		<title>{escape_xml(title)}</title>
		<link>{link}</link>
		<pubDate>Fri, 21 Feb 2026 05:30:00 +0000</pubDate>
		<dc:creator><![CDATA[wordpress]]></dc:creator>
		<description></description>
		<content:encoded><![CDATA[{content_escaped}]]></content:encoded>
		<excerpt:encoded><![CDATA[]]></excerpt:encoded>
		<wp:post_id>{post_id}</wp:post_id>
		<wp:post_name>{post_name}</wp:post_name>
		<wp:post_parent>0</wp:post_parent>
		<wp:menu_order>0</wp:menu_order>
		<wp:post_type>page</wp:post_type>
		<wp:post_password></wp:post_password>
		<wp:status>publish</wp:status>
		<wp:post_date>2026-02-21 05:30:00</wp:post_date>
		<wp:post_date_gmt>2026-02-21 05:30:00</wp:post_date_gmt>
		<wp:post_modified>2026-02-21 05:30:00</wp:post_modified>
		<wp:post_modified_gmt>2026-02-21 05:30:00</wp:post_modified_gmt>
		<wp:comment_status>closed</wp:comment_status>
		<wp:ping_status>closed</wp:ping_status>
		<wp:is_sticky>0</wp:is_sticky>
	</item>
"""
    return item


def make_attachment_item(url, filename, post_id):
    """Create a valid WXR attachment item"""
    item = f"""	<item>
		<title>{escape_xml(filename)}</title>
		<link>{url}</link>
		<wp:post_id>{post_id}</wp:post_id>
		<wp:post_name>{filename.rsplit('.', 1)[0].lower()}</wp:post_name>
		<wp:post_parent>0</wp:post_parent>
		<wp:post_type>attachment</wp:post_type>
		<wp:post_password></wp:post_password>
		<wp:status>inherit</wp:status>
		<wp:post_date>2026-02-21 05:30:00</wp:post_date>
		<wp:post_date_gmt>2026-02-21 05:30:00</wp:post_date_gmt>
		<wp:post_modified>2026-02-21 05:30:00</wp:post_modified>
		<wp:post_modified_gmt>2026-02-21 05:30:00</wp:post_modified_gmt>
		<wp:comment_status>closed</wp:comment_status>
		<wp:ping_status>closed</wp:ping_status>
		<wp:post_type>attachment</wp:post_type>
		<wp:attachment_url>https://ucondieresis.com/wp-content/uploads/{filename}</wp:attachment_url>
	</item>
"""
    return item


def build():
    """Build a valid WordPress WXR file"""
    
    # XML Header with all required namespaces
    wxr_header = """<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0"
	xmlns:excerpt="http://wordpress.org/export/1.2/excerpt/"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:wp="http://wordpress.org/export/1.2/">
<channel>
	<title>Ü con Diéresis</title>
	<link>{}</link>
	<description>Migración de ucondieresis.com a WordPress</description>
	<pubDate>Fri, 21 Feb 2026 05:30:00 +0000</pubDate>
	<language>es-mx</language>
	<wp:wxr_version>1.2</wp:wxr_version>
	<wp:base_blog_url>{}</wp:base_blog_url>
	<wp:base_site_url>{}</wp:base_site_url>
""".format(SITE_URL, BLOG_URL, SITE_URL)

    items = []
    post_id = 1

    # Add pages
    for fname, slug in PAGE_FILES.items():
        fpath = os.path.join(BACKUP_DIR, fname)
        if os.path.exists(fpath):
            html = read_file(fpath)
            title = extract_title(html) or fname.replace('.html', '').title()
            body = extract_body(html)
            if body:  # Only add if has content
                items.append(make_page_item(title, slug, body, post_id))
                post_id += 1

    # Add attachments
    if os.path.exists(IMAGES_MAP):
        try:
            with open(IMAGES_MAP, 'r', encoding='utf-8') as jf:
                mapping = json.load(jf)
            for url, relpath in mapping.items():
                filename = os.path.basename(relpath)
                items.append(make_attachment_item(url, filename, post_id))
                post_id += 1
        except Exception as e:
            print(f"Warning: Could not load images: {e}")

    # Write WXR file
    with open(OUT_WXR, 'w', encoding='utf-8') as f:
        f.write(wxr_header)
        for item in items:
            f.write(item)
        f.write("</channel>\n</rss>")

    print(f"✓ Valid WXR created: {OUT_WXR}")
    print(f"  Items: {len(items)} (pages + attachments)")


if __name__ == '__main__':
    build()
