@if (count($banners['mid']) > 0)
<div class="banners">
    <div class="container">
        <div class="row w-100 g-md-4 g-1">
            @foreach($banners['mid'] as $row)
            <div class="col-md-6 ">
                <a href="{{@$row['link']}}">
                    <img src="{{asset('assets/uploads/content/sli/'.@$row['image'])}}" class="w-100 h-auto" width="700"
                        height="300" alt="{{@$row['title']}}" title="{{@$row['title']}}" loading="lazy" />
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif