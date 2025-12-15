@extends('layouts._site.master')
@section('content')

<main class="content">
	@include('layouts._site.blocks.content')
</main>
<script type="application/ld+json">
    {
      "@context": "https://schema.org/",
      "@type": "WebSite",
      "name": "{!! @$setting_header->title !!}",
      "url": "{{ url()->current() }}",
      "sameAs": "",
      "description": "{!! @$setting_header->description_seo !!}",
      "image": "{{asset('assets/uploads/content/set/'.@$setting_header->logo)}}",
      "alternateName": "{!! @$setting_header->h1 !!}"
    }
</script>
@stop