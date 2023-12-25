<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    @foreach($query as $value)
        <url>
            <loc>
                {{ urldecode(route('product.show',$value->id.'-'.Str::slug($value->title_en))) }}
            </loc>
            <lastmod>{{ $value->updated_at != '' ? $value->updated_at->format('Y-m-d\TH:i:sP') : '' }}</lastmod>
            <changefreq>hourly</changefreq>
            <priority>0.9</priority>
            <image:image>
                <image:loc>
                    @if(isset($value->picfirst->id))
                        {{ asset($value->picfirst->link) }}
                    @else
                        {{ asset('img/favicon.png') }}
                    @endif
                </image:loc>
                <image:caption>{{ $value->title }}</image:caption>
                <image:title>{{ $value->title }}</image:title>
            </image:image>
        </url>
    @endforeach
</urlset>
