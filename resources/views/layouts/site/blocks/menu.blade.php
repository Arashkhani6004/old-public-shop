<nav>
    @include('layouts.site.blocks._partials.banner-top')
    {{-- menu desktop --}}
    @include('layouts.site.blocks._partials.menu-desktop')

    {{-- menu mobile --}}
    @include('layouts.site.blocks._partials.menu-mobile')
</nav>

{{-- sidebar menu mobile --}}
@include('layouts.site.blocks._partials.sidebar-menu')

{{-- search modal --}}
@include('layouts.site.blocks._partials.search-modal')
