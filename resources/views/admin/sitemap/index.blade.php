@extends('layouts.admin.master')
@section('title','تنظیمات')
@section('content')
@if(count($data) > 0)
<div class="container-fluid dashboard-content">
    <div class="row w-100 m-0">
        <div class="col-lg-12 mx-auto py-1 px-0">
            <h3 class="bg-white py-2 px-4 rounded-lg">
                تنظیمات
            </h3>
            <div class="card rounded-lg border-0 p-3">
                <form enctype="multipart/form-data" action="{{url('adminstrator/sitemap/edit')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <h4 class="bg-warning py-2 text-center">تنظیمات سایت مپ</h4>
                        @foreach($data as $d)
                        <div class="col-lg-6 form-group">
                            <label for="title" class="col-form-label">changefreq (@if($d->type == 1) مقالات @elseif($d->type == 2) دسته بندی مقاله @elseif($d->type == 3) محصولات @elseif($d->type == 4) دسته بندی  @elseif($d->type == 5) برند ها  @elseif($d->type == 6) صفحه اول  @elseif($d->type == 7) برند   @elseif($d->type == 8) تماس با ما  @elseif($d->type == 9) درباره ما  @elseif($d->type == 10) لندینگ مقالات  @elseif($d->type == 11) قوانین @elseif($d->type == 12) صفحات ایستا @elseif($d->type == 13) صفحات تگ  @endif) </label>
                                <select class="form-control" name="changefreq[{{$d->id}}]">
                                    <option value="always"  @if($d->changefreq === "always") selected @endif data-select2-id="select2-data-9-kl38">always</option>
                                    <option value="hourly"  @if($d->changefreq === "hourly") selected @endif data-select2-id="select2-data-9-kl38">hourly</option>
                                    <option value="daily"   @if($d->changefreq === "daily") selected @endif data-select2-id="select2-data-9-kl38">daily</option>
                                    <option value="weekly"  @if($d->changefreq === "weekly") selected @endif data-select2-id="select2-data-9-kl38">weekly</option>
                                    <option value="monthly" @if($d->changefreq === "monthly") selected @endif data-select2-id="select2-data-9-kl38">monthly</option>
                                    <option value="yearly"  @if($d->changefreq === "yearly") selected @endif data-select2-id="select2-data-9-kl38">yearly</option>
                                    <option value="never"   @if($d->changefreq === "never") selected @endif data-select2-id="select2-data-9-kl38">never</option>
                                </select>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="h1" class="col-form-label">priority (@if($d->type == 1) مقالات @elseif($d->type == 2) دسته بندی مقاله @elseif($d->type == 3) محصولات @elseif($d->type == 4) دسته بندی  @elseif($d->type == 5) برند ها  @elseif($d->type == 6) صفحه اول  @elseif($d->type == 7) برند   @elseif($d->type == 8) تماس با ما  @elseif($d->type == 9) درباره ما  @elseif($d->type == 10) لندینگ مقالات  @elseif($d->type == 11) قوانین @elseif($d->type == 12) صفحات ایستا @elseif($d->type == 13) صفحات تگ @endif)  </label>
                                <select class="form-control" name="priority[{{$d->id}}]">
                                    <option value="0.0" @if($d->priority === "0.0") selected @endif data-select2-id="select2-data-9-kl38">0.0</option>
                                    <option value="0.1" @if($d->priority === "0.1") selected @endif data-select2-id="select2-data-9-kl38">0.1</option>
                                    <option value="0.2" @if($d->priority === "0.2") selected @endif data-select2-id="select2-data-9-kl38">0.2</option>
                                    <option value="0.3" @if($d->priority === "0.3") selected @endif data-select2-id="select2-data-9-kl38">0.3</option>
                                    <option value="0.4" @if($d->priority === "0.4") selected @endif data-select2-id="select2-data-9-kl38">0.4</option>
                                    <option value="0.5" @if($d->priority === "0.5") selected @endif data-select2-id="select2-data-9-kl38">0.5</option>
                                    <option value="0.6" @if($d->priority === "0.6") selected @endif data-select2-id="select2-data-9-kl38">0.6</option>
                                    <option value="0.7" @if($d->priority === "0.7") selected @endif data-select2-id="select2-data-9-kl38">0.7</option>
                                    <option value="0.8" @if($d->priority === "0.8") selected @endif data-select2-id="select2-data-9-kl38">0.8</option>
                                    <option value="0.9" @if($d->priority === "0.9") selected @endif data-select2-id="select2-data-9-kl38">0.9</option>
                                    <option value="1.0" @if($d->priority === "1.0") selected @endif data-select2-id="select2-data-9-kl38">1.0</option>
                                </select>
                        </div>
                        @endforeach
                    </div>
                    <div class="col-lg-12 p-2">
                        <div class="form-group">
                            <button type="submit" class="btn btn-space btn-success m-0 px-5">ذخیره</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    @else
    <div class="container-fluid dashboard-content">
        <div class="row w-100 m-0">
            <div class="col-lg-12 mx-auto py-1 px-0">
                <h3 class="bg-white py-2 px-4 rounded-lg">
                    تنظیمات
                </h3>
                <div class="card rounded-lg border-0 p-3">
                    <form enctype="multipart/form-data" action="{{url('adminstrator/sitemap/add')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <h4 class="bg-warning py-2 text-center">تنظیمات سایت مپ</h4>
                            <div class="col-lg-6 form-group">
                                <label for="title" class="col-form-label">changefreq (مقالات)</label>
                                    <select class="form-control" name="changefreq[1]">
                                        <option value="always"  data-select2-id="select2-data-9-kl38">always</option>
                                        <option value="hourly"  data-select2-id="select2-data-9-kl38">hourly</option>
                                        <option value="daily"   data-select2-id="select2-data-9-kl38">daily</option>
                                        <option value="weekly"  data-select2-id="select2-data-9-kl38">weekly</option>
                                        <option value="monthly" data-select2-id="select2-data-9-kl38">monthly</option>
                                        <option value="yearly"  data-select2-id="select2-data-9-kl38">yearly</option>
                                        <option value="never"   data-select2-id="select2-data-9-kl38">never</option>
                                    </select>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="h1" class="col-form-label">priority (مقالات)</label>
                                    <select class="form-control" name="priority[1]">
                                        <option value="0.0"  data-select2-id="select2-data-9-kl38">0.0</option>
                                        <option value="0.1"  data-select2-id="select2-data-9-kl38">0.1</option>
                                        <option value="0.2"  data-select2-id="select2-data-9-kl38">0.2</option>
                                        <option value="0.3"  data-select2-id="select2-data-9-kl38">0.3</option>
                                        <option value="0.4"  data-select2-id="select2-data-9-kl38">0.4</option>
                                        <option value="0.5"  data-select2-id="select2-data-9-kl38">0.5</option>
                                        <option value="0.6"  data-select2-id="select2-data-9-kl38">0.6</option>
                                        <option value="0.7"  data-select2-id="select2-data-9-kl38">0.7</option>
                                        <option value="0.8"  data-select2-id="select2-data-9-kl38">0.8</option>
                                        <option value="0.9"  data-select2-id="select2-data-9-kl38">0.9</option>
                                        <option value="1.0"  data-select2-id="select2-data-9-kl38">1.0</option>
                                    </select>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="title" class="col-form-label">changefreq (دسته بندی مقالات)</label>
                                <select class="form-control" name="changefreq[2]">
                                    <option value="always"  data-select2-id="select2-data-9-kl38">always</option>
                                    <option value="hourly"  data-select2-id="select2-data-9-kl38">hourly</option>
                                    <option value="daily"   data-select2-id="select2-data-9-kl38">daily</option>
                                    <option value="weekly"  data-select2-id="select2-data-9-kl38">weekly</option>
                                    <option value="monthly" data-select2-id="select2-data-9-kl38">monthly</option>
                                    <option value="yearly"  data-select2-id="select2-data-9-kl38">yearly</option>
                                    <option value="never"   data-select2-id="select2-data-9-kl38">never</option>
                                </select>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="h1" class="col-form-label">priority (دسته بندی مقالات)</label>
                                <select class="form-control" name="priority[2]">
                                    <option value="0.0"  data-select2-id="select2-data-9-kl38">0.0</option>
                                    <option value="0.1"  data-select2-id="select2-data-9-kl38">0.1</option>
                                    <option value="0.2"  data-select2-id="select2-data-9-kl38">0.2</option>
                                    <option value="0.3"  data-select2-id="select2-data-9-kl38">0.3</option>
                                    <option value="0.4"  data-select2-id="select2-data-9-kl38">0.4</option>
                                    <option value="0.5"  data-select2-id="select2-data-9-kl38">0.5</option>
                                    <option value="0.6"  data-select2-id="select2-data-9-kl38">0.6</option>
                                    <option value="0.7"  data-select2-id="select2-data-9-kl38">0.7</option>
                                    <option value="0.8"  data-select2-id="select2-data-9-kl38">0.8</option>
                                    <option value="0.9"  data-select2-id="select2-data-9-kl38">0.9</option>
                                    <option value="1.0"  data-select2-id="select2-data-9-kl38">1.0</option>
                                </select>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="title" class="col-form-label">changefreq (محصولات)</label>
                                <select class="form-control" name="changefreq[3]">
                                    <option value="always"  data-select2-id="select2-data-9-kl38">always</option>
                                    <option value="hourly"  data-select2-id="select2-data-9-kl38">hourly</option>
                                    <option value="daily"   data-select2-id="select2-data-9-kl38">daily</option>
                                    <option value="weekly"  data-select2-id="select2-data-9-kl38">weekly</option>
                                    <option value="monthly" data-select2-id="select2-data-9-kl38">monthly</option>
                                    <option value="yearly"  data-select2-id="select2-data-9-kl38">yearly</option>
                                    <option value="never"   data-select2-id="select2-data-9-kl38">never</option>
                                </select>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="h1" class="col-form-label">priority (محصولات)</label>
                                <select class="form-control" name="priority[3]">
                                    <option value="0.0"  data-select2-id="select2-data-9-kl38">0.0</option>
                                    <option value="0.1"  data-select2-id="select2-data-9-kl38">0.1</option>
                                    <option value="0.2"  data-select2-id="select2-data-9-kl38">0.2</option>
                                    <option value="0.3"  data-select2-id="select2-data-9-kl38">0.3</option>
                                    <option value="0.4"  data-select2-id="select2-data-9-kl38">0.4</option>
                                    <option value="0.5"  data-select2-id="select2-data-9-kl38">0.5</option>
                                    <option value="0.6"  data-select2-id="select2-data-9-kl38">0.6</option>
                                    <option value="0.7"  data-select2-id="select2-data-9-kl38">0.7</option>
                                    <option value="0.8"  data-select2-id="select2-data-9-kl38">0.8</option>
                                    <option value="0.9"  data-select2-id="select2-data-9-kl38">0.9</option>
                                    <option value="1.0"  data-select2-id="select2-data-9-kl38">1.0</option>
                                </select>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="title" class="col-form-label">changefreq (دسته بندی)</label>
                                <select class="form-control" name="changefreq[4]">
                                    <option value="always"  data-select2-id="select2-data-9-kl38">always</option>
                                    <option value="hourly"  data-select2-id="select2-data-9-kl38">hourly</option>
                                    <option value="daily"   data-select2-id="select2-data-9-kl38">daily</option>
                                    <option value="weekly"  data-select2-id="select2-data-9-kl38">weekly</option>
                                    <option value="monthly" data-select2-id="select2-data-9-kl38">monthly</option>
                                    <option value="yearly"  data-select2-id="select2-data-9-kl38">yearly</option>
                                    <option value="never"   data-select2-id="select2-data-9-kl38">never</option>
                                </select>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="h1" class="col-form-label">priority (دسته بندی)</label>
                                <select class="form-control" name="priority[4]">
                                    <option value="0.0"  data-select2-id="select2-data-9-kl38">0.0</option>
                                    <option value="0.1"  data-select2-id="select2-data-9-kl38">0.1</option>
                                    <option value="0.2"  data-select2-id="select2-data-9-kl38">0.2</option>
                                    <option value="0.3"  data-select2-id="select2-data-9-kl38">0.3</option>
                                    <option value="0.4"  data-select2-id="select2-data-9-kl38">0.4</option>
                                    <option value="0.5"  data-select2-id="select2-data-9-kl38">0.5</option>
                                    <option value="0.6"  data-select2-id="select2-data-9-kl38">0.6</option>
                                    <option value="0.7"  data-select2-id="select2-data-9-kl38">0.7</option>
                                    <option value="0.8"  data-select2-id="select2-data-9-kl38">0.8</option>
                                    <option value="0.9"  data-select2-id="select2-data-9-kl38">0.9</option>
                                    <option value="1.0"  data-select2-id="select2-data-9-kl38">1.0</option>
                                </select>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="title" class="col-form-label">changefreq (برند ها)</label>
                                <select class="form-control" name="changefreq[5]">
                                    <option value="always"  data-select2-id="select2-data-9-kl38">always</option>
                                    <option value="hourly"  data-select2-id="select2-data-9-kl38">hourly</option>
                                    <option value="daily"   data-select2-id="select2-data-9-kl38">daily</option>
                                    <option value="weekly"  data-select2-id="select2-data-9-kl38">weekly</option>
                                    <option value="monthly" data-select2-id="select2-data-9-kl38">monthly</option>
                                    <option value="yearly"  data-select2-id="select2-data-9-kl38">yearly</option>
                                    <option value="never"   data-select2-id="select2-data-9-kl38">never</option>
                                </select>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="h1" class="col-form-label">priority (برند ها)</label>
                                <select class="form-control" name="priority[5]">
                                    <option value="0.0"  data-select2-id="select2-data-9-kl38">0.0</option>
                                    <option value="0.1"  data-select2-id="select2-data-9-kl38">0.1</option>
                                    <option value="0.2"  data-select2-id="select2-data-9-kl38">0.2</option>
                                    <option value="0.3"  data-select2-id="select2-data-9-kl38">0.3</option>
                                    <option value="0.4"  data-select2-id="select2-data-9-kl38">0.4</option>
                                    <option value="0.5"  data-select2-id="select2-data-9-kl38">0.5</option>
                                    <option value="0.6"  data-select2-id="select2-data-9-kl38">0.6</option>
                                    <option value="0.7"  data-select2-id="select2-data-9-kl38">0.7</option>
                                    <option value="0.8"  data-select2-id="select2-data-9-kl38">0.8</option>
                                    <option value="0.9"  data-select2-id="select2-data-9-kl38">0.9</option>
                                    <option value="1.0"  data-select2-id="select2-data-9-kl38">1.0</option>
                                </select>
                            </div>
                            {{-- sabet ha --}}
                            <div class="col-lg-6 form-group">
                                <label for="title" class="col-form-label">changefreq (صفجه اول)</label>
                                <select class="form-control" name="changefreq[6]">
                                    <option value="always"  data-select2-id="select2-data-9-kl38">always</option>
                                    <option value="hourly"  data-select2-id="select2-data-9-kl38">hourly</option>
                                    <option value="daily"   data-select2-id="select2-data-9-kl38">daily</option>
                                    <option value="weekly"  data-select2-id="select2-data-9-kl38">weekly</option>
                                    <option value="monthly" data-select2-id="select2-data-9-kl38">monthly</option>
                                    <option value="yearly"  data-select2-id="select2-data-9-kl38">yearly</option>
                                    <option value="never"   data-select2-id="select2-data-9-kl38">never</option>
                                </select>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="h1" class="col-form-label">priority (صفجه اول)</label>
                                <select class="form-control" name="priority[6]">
                                    <option value="0.0"  data-select2-id="select2-data-9-kl38">0.0</option>
                                    <option value="0.1"  data-select2-id="select2-data-9-kl38">0.1</option>
                                    <option value="0.2"  data-select2-id="select2-data-9-kl38">0.2</option>
                                    <option value="0.3"  data-select2-id="select2-data-9-kl38">0.3</option>
                                    <option value="0.4"  data-select2-id="select2-data-9-kl38">0.4</option>
                                    <option value="0.5"  data-select2-id="select2-data-9-kl38">0.5</option>
                                    <option value="0.6"  data-select2-id="select2-data-9-kl38">0.6</option>
                                    <option value="0.7"  data-select2-id="select2-data-9-kl38">0.7</option>
                                    <option value="0.8"  data-select2-id="select2-data-9-kl38">0.8</option>
                                    <option value="0.9"  data-select2-id="select2-data-9-kl38">0.9</option>
                                    <option value="1.0"  data-select2-id="select2-data-9-kl38">1.0</option>
                                </select>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="title" class="col-form-label">changefreq (برند )</label>
                                <select class="form-control" name="changefreq[7]">
                                    <option value="always"  data-select2-id="select2-data-9-kl38">always</option>
                                    <option value="hourly"  data-select2-id="select2-data-9-kl38">hourly</option>
                                    <option value="daily"   data-select2-id="select2-data-9-kl38">daily</option>
                                    <option value="weekly"  data-select2-id="select2-data-9-kl38">weekly</option>
                                    <option value="monthly" data-select2-id="select2-data-9-kl38">monthly</option>
                                    <option value="yearly"  data-select2-id="select2-data-9-kl38">yearly</option>
                                    <option value="never"   data-select2-id="select2-data-9-kl38">never</option>
                                </select>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="h1" class="col-form-label">priority (برند )</label>
                                <select class="form-control" name="priority[7]">
                                    <option value="0.0"  data-select2-id="select2-data-9-kl38">0.0</option>
                                    <option value="0.1"  data-select2-id="select2-data-9-kl38">0.1</option>
                                    <option value="0.2"  data-select2-id="select2-data-9-kl38">0.2</option>
                                    <option value="0.3"  data-select2-id="select2-data-9-kl38">0.3</option>
                                    <option value="0.4"  data-select2-id="select2-data-9-kl38">0.4</option>
                                    <option value="0.5"  data-select2-id="select2-data-9-kl38">0.5</option>
                                    <option value="0.6"  data-select2-id="select2-data-9-kl38">0.6</option>
                                    <option value="0.7"  data-select2-id="select2-data-9-kl38">0.7</option>
                                    <option value="0.8"  data-select2-id="select2-data-9-kl38">0.8</option>
                                    <option value="0.9"  data-select2-id="select2-data-9-kl38">0.9</option>
                                    <option value="1.0"  data-select2-id="select2-data-9-kl38">1.0</option>
                                </select>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="title" class="col-form-label">changefreq (تماس باما)</label>
                                <select class="form-control" name="changefreq[8]">
                                    <option value="always"  data-select2-id="select2-data-9-kl38">always</option>
                                    <option value="hourly"  data-select2-id="select2-data-9-kl38">hourly</option>
                                    <option value="daily"   data-select2-id="select2-data-9-kl38">daily</option>
                                    <option value="weekly"  data-select2-id="select2-data-9-kl38">weekly</option>
                                    <option value="monthly" data-select2-id="select2-data-9-kl38">monthly</option>
                                    <option value="yearly"  data-select2-id="select2-data-9-kl38">yearly</option>
                                    <option value="never"   data-select2-id="select2-data-9-kl38">never</option>
                                </select>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="h1" class="col-form-label">priority (تماس باما)</label>
                                <select class="form-control" name="priority[8]">
                                    <option value="0.0"  data-select2-id="select2-data-9-kl38">0.0</option>
                                    <option value="0.1"  data-select2-id="select2-data-9-kl38">0.1</option>
                                    <option value="0.2"  data-select2-id="select2-data-9-kl38">0.2</option>
                                    <option value="0.3"  data-select2-id="select2-data-9-kl38">0.3</option>
                                    <option value="0.4"  data-select2-id="select2-data-9-kl38">0.4</option>
                                    <option value="0.5"  data-select2-id="select2-data-9-kl38">0.5</option>
                                    <option value="0.6"  data-select2-id="select2-data-9-kl38">0.6</option>
                                    <option value="0.7"  data-select2-id="select2-data-9-kl38">0.7</option>
                                    <option value="0.8"  data-select2-id="select2-data-9-kl38">0.8</option>
                                    <option value="0.9"  data-select2-id="select2-data-9-kl38">0.9</option>
                                    <option value="1.0"  data-select2-id="select2-data-9-kl38">1.0</option>
                                </select>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="title" class="col-form-label">changefreq (درباره ما)</label>
                                <select class="form-control" name="changefreq[9]">
                                    <option value="always"  data-select2-id="select2-data-9-kl38">always</option>
                                    <option value="hourly"  data-select2-id="select2-data-9-kl38">hourly</option>
                                    <option value="daily"   data-select2-id="select2-data-9-kl38">daily</option>
                                    <option value="weekly"  data-select2-id="select2-data-9-kl38">weekly</option>
                                    <option value="monthly" data-select2-id="select2-data-9-kl38">monthly</option>
                                    <option value="yearly"  data-select2-id="select2-data-9-kl38">yearly</option>
                                    <option value="never"   data-select2-id="select2-data-9-kl38">never</option>
                                </select>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="h1" class="col-form-label">priority (درباره ما)</label>
                                <select class="form-control" name="priority[9]">
                                    <option value="0.0"  data-select2-id="select2-data-9-kl38">0.0</option>
                                    <option value="0.1"  data-select2-id="select2-data-9-kl38">0.1</option>
                                    <option value="0.2"  data-select2-id="select2-data-9-kl38">0.2</option>
                                    <option value="0.3"  data-select2-id="select2-data-9-kl38">0.3</option>
                                    <option value="0.4"  data-select2-id="select2-data-9-kl38">0.4</option>
                                    <option value="0.5"  data-select2-id="select2-data-9-kl38">0.5</option>
                                    <option value="0.6"  data-select2-id="select2-data-9-kl38">0.6</option>
                                    <option value="0.7"  data-select2-id="select2-data-9-kl38">0.7</option>
                                    <option value="0.8"  data-select2-id="select2-data-9-kl38">0.8</option>
                                    <option value="0.9"  data-select2-id="select2-data-9-kl38">0.9</option>
                                    <option value="1.0"  data-select2-id="select2-data-9-kl38">1.0</option>
                                </select>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="title" class="col-form-label">changefreq (لندینگ مقالات)</label>
                                <select class="form-control" name="changefreq[10]">
                                    <option value="always"  data-select2-id="select2-data-9-kl38">always</option>
                                    <option value="hourly"  data-select2-id="select2-data-9-kl38">hourly</option>
                                    <option value="daily"   data-select2-id="select2-data-9-kl38">daily</option>
                                    <option value="weekly"  data-select2-id="select2-data-9-kl38">weekly</option>
                                    <option value="monthly" data-select2-id="select2-data-9-kl38">monthly</option>
                                    <option value="yearly"  data-select2-id="select2-data-9-kl38">yearly</option>
                                    <option value="never"   data-select2-id="select2-data-9-kl38">never</option>
                                </select>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="h1" class="col-form-label">priority (لندینگ مقالات)</label>
                                <select class="form-control" name="priority[10]">
                                    <option value="0.0"  data-select2-id="select2-data-9-kl38">0.0</option>
                                    <option value="0.1"  data-select2-id="select2-data-9-kl38">0.1</option>
                                    <option value="0.2"  data-select2-id="select2-data-9-kl38">0.2</option>
                                    <option value="0.3"  data-select2-id="select2-data-9-kl38">0.3</option>
                                    <option value="0.4"  data-select2-id="select2-data-9-kl38">0.4</option>
                                    <option value="0.5"  data-select2-id="select2-data-9-kl38">0.5</option>
                                    <option value="0.6"  data-select2-id="select2-data-9-kl38">0.6</option>
                                    <option value="0.7"  data-select2-id="select2-data-9-kl38">0.7</option>
                                    <option value="0.8"  data-select2-id="select2-data-9-kl38">0.8</option>
                                    <option value="0.9"  data-select2-id="select2-data-9-kl38">0.9</option>
                                    <option value="1.0"  data-select2-id="select2-data-9-kl38">1.0</option>
                                </select>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="title" class="col-form-label">changefreq (مقررات)</label>
                                <select class="form-control" name="changefreq[11]">
                                    <option value="always"  data-select2-id="select2-data-9-kl38">always</option>
                                    <option value="hourly"  data-select2-id="select2-data-9-kl38">hourly</option>
                                    <option value="daily"   data-select2-id="select2-data-9-kl38">daily</option>
                                    <option value="weekly"  data-select2-id="select2-data-9-kl38">weekly</option>
                                    <option value="monthly" data-select2-id="select2-data-9-kl38">monthly</option>
                                    <option value="yearly"  data-select2-id="select2-data-9-kl38">yearly</option>
                                    <option value="never"   data-select2-id="select2-data-9-kl38">never</option>
                                </select>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="h1" class="col-form-label">priority (مقررات)</label>
                                <select class="form-control" name="priority[11]">
                                    <option value="0.0"  data-select2-id="select2-data-9-kl38">0.0</option>
                                    <option value="0.1"  data-select2-id="select2-data-9-kl38">0.1</option>
                                    <option value="0.2"  data-select2-id="select2-data-9-kl38">0.2</option>
                                    <option value="0.3"  data-select2-id="select2-data-9-kl38">0.3</option>
                                    <option value="0.4"  data-select2-id="select2-data-9-kl38">0.4</option>
                                    <option value="0.5"  data-select2-id="select2-data-9-kl38">0.5</option>
                                    <option value="0.6"  data-select2-id="select2-data-9-kl38">0.6</option>
                                    <option value="0.7"  data-select2-id="select2-data-9-kl38">0.7</option>
                                    <option value="0.8"  data-select2-id="select2-data-9-kl38">0.8</option>
                                    <option value="0.9"  data-select2-id="select2-data-9-kl38">0.9</option>
                                    <option value="1.0"  data-select2-id="select2-data-9-kl38">1.0</option>
                                </select>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="title" class="col-form-label">changefreq (صفحات ایستا)</label>
                                <select class="form-control" name="changefreq[12]">
                                    <option value="always"  data-select2-id="select2-data-9-kl38">always</option>
                                    <option value="hourly"  data-select2-id="select2-data-9-kl38">hourly</option>
                                    <option value="daily"   data-select2-id="select2-data-9-kl38">daily</option>
                                    <option value="weekly"  data-select2-id="select2-data-9-kl38">weekly</option>
                                    <option value="monthly" data-select2-id="select2-data-9-kl38">monthly</option>
                                    <option value="yearly"  data-select2-id="select2-data-9-kl38">yearly</option>
                                    <option value="never"   data-select2-id="select2-data-9-kl38">never</option>
                                </select>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="h1" class="col-form-label">priority (صفحات ایستا)</label>
                                <select class="form-control" name="priority[12]">
                                    <option value="0.0"  data-select2-id="select2-data-9-kl38">0.0</option>
                                    <option value="0.1"  data-select2-id="select2-data-9-kl38">0.1</option>
                                    <option value="0.2"  data-select2-id="select2-data-9-kl38">0.2</option>
                                    <option value="0.3"  data-select2-id="select2-data-9-kl38">0.3</option>
                                    <option value="0.4"  data-select2-id="select2-data-9-kl38">0.4</option>
                                    <option value="0.5"  data-select2-id="select2-data-9-kl38">0.5</option>
                                    <option value="0.6"  data-select2-id="select2-data-9-kl38">0.6</option>
                                    <option value="0.7"  data-select2-id="select2-data-9-kl38">0.7</option>
                                    <option value="0.8"  data-select2-id="select2-data-9-kl38">0.8</option>
                                    <option value="0.9"  data-select2-id="select2-data-9-kl38">0.9</option>
                                    <option value="1.0"  data-select2-id="select2-data-9-kl38">1.0</option>
                                </select>
                            </div>
                              <div class="col-lg-6 form-group">
                                <label for="title" class="col-form-label">changefreq (صفحات تگ)</label>
                                <select class="form-control" name="changefreq[13]">
                                    <option value="always"  data-select2-id="select2-data-9-kl38">always</option>
                                    <option value="hourly"  data-select2-id="select2-data-9-kl38">hourly</option>
                                    <option value="daily"   data-select2-id="select2-data-9-kl38">daily</option>
                                    <option value="weekly"  data-select2-id="select2-data-9-kl38">weekly</option>
                                    <option value="monthly" data-select2-id="select2-data-9-kl38">monthly</option>
                                    <option value="yearly"  data-select2-id="select2-data-9-kl38">yearly</option>
                                    <option value="never"   data-select2-id="select2-data-9-kl38">never</option>
                                </select>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="h1" class="col-form-label">priority (صفحات تگ)</label>
                                <select class="form-control" name="priority[13]">
                                    <option value="0.0"  data-select2-id="select2-data-9-kl38">0.0</option>
                                    <option value="0.1"  data-select2-id="select2-data-9-kl38">0.1</option>
                                    <option value="0.2"  data-select2-id="select2-data-9-kl38">0.2</option>
                                    <option value="0.3"  data-select2-id="select2-data-9-kl38">0.3</option>
                                    <option value="0.4"  data-select2-id="select2-data-9-kl38">0.4</option>
                                    <option value="0.5"  data-select2-id="select2-data-9-kl38">0.5</option>
                                    <option value="0.6"  data-select2-id="select2-data-9-kl38">0.6</option>
                                    <option value="0.7"  data-select2-id="select2-data-9-kl38">0.7</option>
                                    <option value="0.8"  data-select2-id="select2-data-9-kl38">0.8</option>
                                    <option value="0.9"  data-select2-id="select2-data-9-kl38">0.9</option>
                                    <option value="1.0"  data-select2-id="select2-data-9-kl38">1.0</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 p-2">
                            <div class="form-group">
                                <button type="submit" class="btn btn-space btn-success m-0 px-5">ذخیره</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
@stop
