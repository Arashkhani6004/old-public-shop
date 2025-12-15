<div class="row w-100 m-0">
    @foreach($mobiles['mid'] as $key=> $row)
        <div class="col-md-12 col-sm-6 col-xs-6 p-1">
            <a @if(@$row['link'] != null) href="{{@$row['link']}}" @endif class="d-flex" style="background-image: url('{{asset('assets/uploads/content/sli/'.@$row['image'])}}');background-position: center center;
  background-repeat: no-repeat;
  background-size: 100% 100%;
  min-height: 12.5rem;"></a>
            <!-- <a @if(@$row['link'] != null) href="{{@$row['link']}}" @endif class="carousel-item" style="background-image: url('{{asset('assets/uploads/content/sli/'.@$row['image'])}}');"></a> -->
        </div>
    @endforeach
</div>
