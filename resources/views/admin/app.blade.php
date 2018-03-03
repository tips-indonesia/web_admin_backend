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
                                <div class="heading-elements">
                                    <div class="heading-btn-group">
                                        <a href="javascript:history.back()" class="btn btn-link btn-float has-text"><i class="icon-arrow-left7 text-primary" id="back"></i>Back</a>
                                    @if (request()->route()->getName() != '')
                                    <a href="{{ url('/admin') }}" class="btn btn-link btn-float has-text"><i class="icon-close2 text-primary"></i>Close</a>
                                    @endif
                                    </div>
                                </div>
                        </div>
                    </div>
                    @yield('content')
                </div>
            </div>
        </div>
        <div id="loading_modal">LOADING... Please Wait...</div>
    </body>
    @include('admin.footer')
</html>