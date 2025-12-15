@extends('site.panel.master')
@section('styles')
<link rel="stylesheet" href="{{asset('assets/site/css/panel/panel.css?0.03')}}">
@stop
@section('content')
<div class="header p-3">
    <p class="fm-md m-0 d-flex align-items-center h3">
        <i class="bi bi-speedometer2 me-2 d-flex"></i>
        داشبورد
    </p>
</div>
<div class="content px-xl-3 py-2">
    <div class="row w-100 m-0">
        @include('site.panel.dashboard._partials.personal-info')
    </div>
</div>
@endsection
