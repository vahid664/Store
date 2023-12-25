<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach($query as $value)
        <url>
            <loc>{{ urldecode(url('brand/'.Str::slug($value->title_en))) }}</loc>
            <lastmod>{{ $value->updated_at != '' ? $value->updated_at->format('Y-m-d\TH:i:sP') : '' }}</lastmod>
            <changefreq>always</changefreq>
            <priority>0.9</priority>
        </url>
    @endforeach
</urlset>
