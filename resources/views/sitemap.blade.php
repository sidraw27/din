<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($sitemap as $item)
        <url>
            <loc>{{ $item['link'] }}</loc>
            <priority>{{ $item['priority'] }}</priority>
            <lastmod>{{ $item['modifyDate'] }}</lastmod>
            <changefreq>monthly</changefreq>
        </url>
    @endforeach
</urlset>