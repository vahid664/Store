<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc>{{ url('sitemap-static.xml') }}</loc>
        @if(isset(\App\Product::active()->orderByDesc('updated_at')->first()->updated_at))
            <lastmod>{{ \App\Product::active()->orderByDesc('updated_at')->first()->updated_at->format('Y-m-d\TH:i:sP') }}</lastmod>
        @endif
    </sitemap>
    @if(isset(\App\Category::active()->orderByDesc('updated_at')->first()->updated_at))
        @for($i=1;$i<=ceil(\App\Category::active()->count()/1000);$i++)
        <sitemap>
            <loc>{{ url('sitemap-category.xml?page='.$i) }}</loc>
            <lastmod>{{ \App\Category::active()->orderByDesc('updated_at')->first()->updated_at->format('Y-m-d\TH:i:sP') }}</lastmod>
        </sitemap>
        @endfor
    @endif
   {{-- <sitemap>
        <loc>{{ url('sitemap-tag.xml') }}</loc>
        <lastmod>{{ \App\Tag::active()->orderByDesc('updated_at')->first()->updated_at->format('Y-m-d\TH:i:sP') }}</lastmod>
    </sitemap>--}}
    @if(isset(\App\Article::active()->orderByDesc('updated_at')->first()->updated_at))
        @for($i=1;$i<=ceil(\App\Article::active()->count()/1000);$i++)
        <sitemap>
            <loc>{{ url('sitemap-blog.xml?page='.$i) }}</loc>
            <lastmod>{{ \App\Article::active()->orderByDesc('updated_at')->first()->updated_at->format('Y-m-d\TH:i:sP') }}</lastmod>
        </sitemap>
        @endfor
    @endif
    @if(isset(\App\Product::active()->orderByDesc('updated_at')->first()->updated_at))
        @for($i=1;$i<=ceil(\App\Product::active()->count()/1000);$i++)
        <sitemap>
            <loc>{{ url('sitemap-post.xml?page='.$i) }}</loc>
            <lastmod>{{ \App\Product::active()->orderByDesc('updated_at')->first()->updated_at->format('Y-m-d\TH:i:sP') }}</lastmod>
        </sitemap>
        @endfor
    @endif
    @if(isset(\App\Brand::active()->orderByDesc('updated_at')->first()->updated_at))
        @for($i=1;$i<=ceil(\App\Brand::active()->count()/1000);$i++)
            <sitemap>
                <loc>{{ url('sitemap-brand.xml?page='.$i) }}</loc>
                <lastmod>{{ \App\Brand::active()->orderByDesc('updated_at')->first()->updated_at->format('Y-m-d\TH:i:sP') }}</lastmod>
            </sitemap>
        @endfor
    @endif
</sitemapindex>
