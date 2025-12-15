<section class="offer my-5 container">
        <div class="row w-100 m-0">
            @foreach($banners['mid'] as $row)
                <div class="col-md col-sm-6 col-xs-12 p-1 mx-auto my-2">
                    <a href="{{@$row['link']}}">
                        <div class="card border-0 rounded-0 bg-transparent">
                            <img height="100%" width="100%" src="{{asset('assets/uploads/content/sli/'.@$row['image'])}}" alt="{{@$row['title']}}" class="img-fluid" loading="lazy">
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
</section>
