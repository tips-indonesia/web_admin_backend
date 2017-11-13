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
                                <h4><span class="text-semibold">@yield('page_title')</h4>
                            </div>
                            @if (request()->route()->getName() != '')
                                <div class="heading-elements">
                                    <div class="heading-btn-group">
                                        <a href="{{ url('/admin') }}" class="btn btn-link btn-float has-text"><i class="icon-close2 text-primary"></i>Close</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    @yield('content')
                </div>
            </div>
        </div>
    </body>
    @include('admin.footer')
</html>