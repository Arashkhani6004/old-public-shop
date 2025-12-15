<!DOCTYPE html>
<html lang="fa" dir="rtl">
@include('layouts.site.blocks.head')

<body class="{{ str_replace('.', '-', request()->getHost()) }}">
    <div id="shop68" v-cloak>
        @include('layouts.site.blocks.menu')
        @include('layouts.site.blocks.menu-app')
        <main>
            @yield('content')
        </main>
        @include('layouts.site.blocks.footer')
    </div>
    @include('layouts.site.blocks.script')
    @include('layouts.message-swal')
</body>

</html>
