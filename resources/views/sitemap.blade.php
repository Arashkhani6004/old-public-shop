<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"
>


    @php
    $sitemap = \App\Models\Sitemap::get();
    @endphp
        <url>
            <loc>
                {{url('/')}}
            </loc>
            <changefreq>@if(isset($sitemap[5]->changefreq)) {{$sitemap[5]->changefreq}} @else monthly @endif</changefreq>
            <priority>@if(isset($sitemap[5]->priority)) {{$sitemap[5]->priority}} @else 0.8 @endif</priority>
        </url>


        <url>
            <loc>
                {{url('/contact-us/')}}
            </loc>
            <changefreq>@if(isset($sitemap[7]->changefreq)) {{$sitemap[7]->changefreq}} @else monthly @endif</changefreq>
            <priority>@if(isset($sitemap[7]->priority)) {{$sitemap[7]->priority}} @else 0.8 @endif</priority>
        </url>

        <url>
            <loc>
                {{url('/about-us/')}}
            </loc>
            <changefreq>@if(isset($sitemap[8]->changefreq)) {{$sitemap[8]->changefreq}} @else monthly @endif</changefreq>
            <priority>@if(isset($sitemap[8]->priority)) {{$sitemap[8]->priority}} @else 0.8 @endif</priority>
        </url>

        <url>
            <loc>
                {{url('/privacy-policy/')}}
            </loc>
            <changefreq>@if(isset($sitemap[10]->changefreq)) {{$sitemap[10]->changefreq}} @else monthly @endif</changefreq>
            <priority>@if(isset($sitemap[10]->priority)) {{$sitemap[10]->priority}} @else 0.8 @endif</priority>
        </url>
        <url>
            <loc>
                {{url('/brands/')}}
            </loc>
            <changefreq>@if(isset($sitemap[6]->changefreq)) {{$sitemap[6]->changefreq}} @else monthly @endif</changefreq>
            <priority>@if(isset($sitemap[6]->priority)) {{$sitemap[6]->priority}} @else 0.8 @endif</priority>
        </url>
        <url>
            <loc>
                {{url('/blogs/')}}
            </loc>
            <changefreq>@if(isset($sitemap[9]->changefreq)) {{$sitemap[9]->changefreq}} @else monthly @endif</changefreq>
            <priority>@if(isset($sitemap[9]->priority)) {{$sitemap[9]->priority}} @else 0.8 @endif</priority>
        </url>
        @foreach($products as $pro)
            <url>
                <loc>
                    {{route('site.product.detail',['id'=>$pro->url])}}
                </loc>
                <changefreq>@if(isset($sitemap[2]->changefreq)) {{$sitemap[2]->changefreq}} @else monthly @endif</changefreq>
                <priority>@if(isset($sitemap[2]->priority)) {{$sitemap[2]->priority}} @else 0.8 @endif</priority>
            </url>
        @endforeach
        @foreach($category as $cat)
            <url>
                <loc>
                    {{route('site.product.list',['id'=>$cat->url])}}
                </loc>
                <changefreq>@if(isset($sitemap[3]->changefreq)) {{$sitemap[3]->changefreq}} @else monthly @endif</changefreq>
                <priority>@if(isset($sitemap[3]->priority)) {{$sitemap[3]->priority}} @else 0.8 @endif</priority>
            </url>
        @endforeach
        {{-- @foreach($article_cat as $arcat)
        @php
        $check = App\Models\Redirects::orderBy('id','DESC')->where('old_address','blogs'.$artcat->id)->first();
        @endphp
        @if ($check == null)
        <url>
            <loc>
                {{route('site.blog.list',['id'=>$arcat->id])}}
            </loc>
            <changefreq>@if(isset($sitemap[1]->changefreq)) {{$sitemap[1]->changefreq}} @else daily @endif</changefreq>
            <priority>@if(isset($sitemap[1]->priority)) {{$sitemap[1]->priority}} @else 0.8 @endif</priority>
        </url>
        @endif
        @endforeach --}}
        @foreach($article_cat as $arcat)
        <url>
            <loc>
                {{route('site.blog.list',['id'=>$arcat->id])}}
            </loc>
            <changefreq>@if(isset($sitemap[1]->changefreq)) {{$sitemap[1]->changefreq}} @else monthly @endif</changefreq>
            <priority>@if(isset($sitemap[1]->priority)) {{$sitemap[1]->priority}} @else 0.8 @endif</priority>
        </url>
        @endforeach
        @foreach($articles as $art)
        @php
        $check = App\Models\Redirects::orderBy('id','DESC')->where('old_address','blog-detail'.$art->id)->first();
        @endphp
        @if ($check == null)
            <url>
                <loc>
                    {{route('site.blog.detail',['id'=>$art->id])}}
                </loc>
                <changefreq>@if(isset($sitemap[0]->changefreq)) {{$sitemap[0]->changefreq}} @else monthly @endif</changefreq>
                <priority>@if(isset($sitemap[0]->priority)) {{$sitemap[0]->priority}} @else 0.8 @endif</priority>
            </url>
        @endif
        @endforeach
        @foreach($brands as $brand)
            <url>
                <loc>
                    {{route('site.brand.detail',['id'=>$brand->url])}}
                </loc>
                <changefreq>@if(isset($sitemap[4]->changefreq)) {{$sitemap[4]->changefreq}} @else monthly @endif</changefreq>
                <priority>@if(isset($sitemap[4]->priority)) {{$sitemap[4]->priority}} @else 0.8 @endif</priority>
            </url>
        @endforeach
                @foreach($tags as $tag)
            <url>
                <loc>
                    {{url('/tag/'.str_replace(' ', '-',$tag->url))}}
                </loc>
                <changefreq>@if(isset($sitemap[4]->changefreq)) {{$sitemap[4]->changefreq}} @else monthly @endif</changefreq>
                <priority>@if(isset($sitemap[4]->priority)) {{$sitemap[4]->priority}} @else 0.8 @endif</priority>
            </url>
        @endforeach
        @foreach($blogs as $blog)
        <url>
            <loc>
                {{route('site.page.detail',['id' => $blog->url])}}
            </loc>
            <changefreq>@if(isset($sitemap[4]->changefreq)){{$sitemap[4]->changefreq}}@else monthly @endif</changefreq>
            <priority>@if(isset($sitemap[4]->priority)) {{$sitemap[4]->priority}} @else 0.8 @endif</priority>
        </url>
         @endforeach
</urlset>
