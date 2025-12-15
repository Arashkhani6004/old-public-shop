@if (count($banners['below']) > 0)
<div class="banners d-lg-block d-none">
    <div class="container-fluid">
        @foreach($banners['below'] as $row)
        <div class="col-md-12 p-0">
            <a href="{{@$row['link']}}">
                <img src="{{asset('assets/uploads/content/sli/'.@$row['image'])}}" class="w-100 h-auto" width="700" height="300"
                    alt="{{@$row['title']}}" title="{{@$row['title']}}" loading="lazy" />
            </a>
        </div>
        @endforeach
    </div>
</div>
@endif
