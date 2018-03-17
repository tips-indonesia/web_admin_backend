@extends('admin.app')

@section('title')
    Promotion
@endsection
@section('page_title')
<span class="text-semibold">Promotion</span> - Show All
<button type="button" class="btn btn-success" onclick="window.location.href='createPromotion'">Create</button>
@endsection
@section('content')
        <table class="table datatable-pagination">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>
                                asdas
                            
                        </td>
                        <td>
                                asdasd
                        </td>                        
                        <td>
                                asdasdasd
                        </td>
                    </tr>
                    <tr>
                        <td>
                                asdas
                            
                        </td>
                        <td>
                                asdasd
                        </td>                        
                        <td>
                                asdasdasd
                        </td>
                    </tr>
            </tbody>
        </table>

    </div>
    <!-- Small modal -->
        <div id="modal_small" class="modal fade">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title">Pending Item</h5>
                    </div>
                    <div class="modal-body">
                            <div class="panel panel-flat">
                                <table class="table datatable-pagination">
                                    <thead>
                                        <tr>
                                            <th>Slot ID</th>
                                            <th>Date</th>
                                            <th>Origin</th>
                                            <th>Destination</th>
                                            <th>Weight</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            
                                        </tr>
                                    </tbody>
                                </table>                            </div>
                    </div>

                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
    <script type="text/javascript">
        
            $('.select-search').select2();
            $('.pickadate-year').datepicker({format: 'yyyy-mm-dd',});
            $('#param').on('select2:select', function() {
                if ($('#param').val() != 'blank') {
                    $('#value').prop('required', true)
                } else {
                    $('#value').prop('required', false)
                }
            });
    </script>

@endsection