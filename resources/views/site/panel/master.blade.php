<!DOCTYPE html>
<html lang="fa" dir="rtl">
    @include('layouts.site.blocks.head')

    <body>
        <div id="shop68" v-cloak>
            @include('layouts.site.blocks.menu')
            @include('layouts.site.blocks.menu-app')
            <main>
                <section class="panel my-4">
                    <div class="container">
                        <div class="row w-100 m-0">
                            <div class="col-lg-3 p-1">
                                {{-- Sidebar Dsktop --}}
                                @include('site.panel.blocks.sidebar')
                                {{-- Sidebar Mobile --}}
                                @include('site.panel.blocks.sidebar-mobile')
                            </div>
                            <div class="col-lg-9 p-1 mt-lg-0 mt-2">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </section>
            </main>

            @include('layouts.site.blocks.footer')
        </div>
        @include('layouts.site.blocks.script')
    </body>

</html>
