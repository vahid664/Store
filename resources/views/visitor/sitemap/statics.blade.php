<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ url('/') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>{{ url('/Blog') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>1</priority>
    </url>
    @foreach($query as $value)
        <url>
            <loc>{{ url('/PageKia/'.Str::slug($value->title_en)) }}</loc>
            <changefreq>weekly</changefreq>
            <priority>0.9</priority>
        </url>
    @endforeach
</urlset>
