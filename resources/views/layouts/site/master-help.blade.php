<!DOCTYPE html>
<html lang="fa" dir="rtl">
@include('layouts.site.blocks-help.head')

<body>
    <div id="shop68" v-cloak>
        @include('layouts.site.blocks-help.menu')
        @include('layouts.site.blocks-help.menu-app')
        <main>
            @yield('content')
        </main>
        @include('layouts.site.blocks-help.footer')
    </div>
    @include('layouts.site.blocks-help.script')
    @include('layouts.message-swal')
</body>

</html>
