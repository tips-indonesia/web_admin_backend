<!DOCTYPE html>
<html lang="en">
    @include('admin.header')
    <body>
        @include('admin.navbar')
        <div class="page-container">
		    <div class="page-content">
                @include('admin.sidebar')
                
                <div class="content-wrapper">
                    <div class="page-header">
                        <div class="page-header-content">
                            <div class="page-title">
                                <h4><span class="text-semibold">@yield('module')</span> - @yield('operation')</h4>
                            </div>
                            @yield('create_button')
                        </div>
                    </div>
                    @yield('content')
                </div>
            </div>
        </div>
    </body>
    @include('admin.footer')
</html>