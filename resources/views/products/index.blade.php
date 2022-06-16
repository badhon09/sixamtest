@extends('layouts.app')
@section('content')
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Products</a></li>

                        </ol>
                    </div>
                    <h4 class="page-title">Products</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->



        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @can('product_add')
                            <div class="text-end mb-3">
                                <a href="{{route('products.add')}}" class="btn btn-md btn-info " ><i class="ft-plus"></i>Create New</a>
                            </div>
                            @endcan

                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="">Search by Purchase/Selling</label>
                                    <input type="text" onkeyup="search()" class="form-control" id="search" placeholder="search by purchase price/selling price">
                                </div>
                            </div>
                        <table id="teamTable" class="table dt-responsive nowrap w-100">
                        </table>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->




        <script>
            $(document).ready(function () {
                var key = $("#search").val()
                $('#teamTable').DataTable({
                    processing: true,
                    serverSide: true,
                    stateSave: true,

                    ajax: {
                        "url": "{!!route('products.list')!!}",
                        "type": "POST",
                        data: function (d) {
                            d._token = "{{csrf_token()}}";

                             d.unit_price=$("#search").val()

                        },
                    },
                    columns: [

                        {title:'Name', data: 'name', name: 'name', class: 'text-center'},
                        {title:'Category', data: 'category.category_name', name: 'category.category_name', class: 'text-center'},
                        {title:'Purchase Price', data: 'purchase_price', name: 'purchase_price', class: 'text-center'},
                        {title:'Selling Price', data: 'unit_price', name: 'unit_price', class: 'text-center'},


                        {title:'Action', data:'action', class:'text-center', orderable: false, searchable:false}
                    ]

                });
            })





            function editTeam(x) {

                var url = '{{route("products.edit", ":id") }}';
                var newUrl=url.replace(':id', x);
                window.location.href = newUrl;
            }


            function deleteTeam(x) {

                if(!confirm("Delete This Product ?")){
                    return false;
                }

                $.ajax({
                    type: 'POST',
                    url: "{!! route('products.delete') !!}",
                    cache: false,
                    data: {_token: "{{csrf_token()}}",'id': x},
                    success: function (data) {
                        $('#teamTable').DataTable().draw();
                    }
                });
            }

            function search() {


                    $('#teamTable').DataTable().draw();

            }

        </script>


        <script>
            @if(Session::has('message'))
                toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
            toastr.success("{{ session('message') }}");
            @endif


        </script>

@endsection
