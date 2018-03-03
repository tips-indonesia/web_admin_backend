@extends('admin.app')

@section('title')
    Term and Agreement
@endsection
@section('page_title')
    <span class="text-semibold">Term and Agreement</span>
@endsection
@section('content')
    <!-- Vertical form options -->
    <div class="row">
        <div class="col-md-12">

            <!-- WYSIHTML5 basic -->
                    <div class="panel panel-flat">

                        <div class="panel-body">
                            <select class="selectpicker" data-live-search="true">
                                <option data-tokens="ketchup mustard">Hot Dog, Fries and a Soda</option>
                                <option data-tokens="mustard">Burger, Shake and a Smile</option>
                                <option data-tokens="frosting">Sugar, Spice and all things nice</option>
                            </select>

                        </div>
                    <!-- /WYSIHTML5 basic -->
        </div>
    </div>
   <script>
@endsection
