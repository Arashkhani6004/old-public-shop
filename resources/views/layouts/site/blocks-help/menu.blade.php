<nav>
    @include('layouts.site.blocks-help._partials.banner-top')
    <section class="top secondary-bg py-2">
    </section>
    {{-- menu desktop --}}
    @include('layouts.site.blocks-help._partials.menu-desktop')

    {{-- menu mobile --}}
    @include('layouts.site.blocks-help._partials.menu-mobile')
</nav>

{{-- sidebar menu mobile --}}
@include('layouts.site.blocks-help._partials.sidebar-menu')

{{-- search modal --}}
@include('layouts.site.blocks-help._partials.search-modal')
