@if (count($banners['above']) > 0)
<div class="banners">
    <div class="container">
        <div class="row w-100 m-0 g-xxl-4 g-lg-3 g-1">
            @foreach($banners['above'] as $row)
            <div class="col-lg-3 col-6">
                <a href="{{@$row['link']}}">
                    <img src="{{asset('assets/uploads/content/sli/'.@$row['image'])}}" class="w-100 h-auto" width="310"
                        height="232" alt="{{@$row['title']}}" title="{{@$row['title']}}" loading="lazy" />
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif