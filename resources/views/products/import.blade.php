@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Products</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Import</a></li>
                    </ol>
                </div>
                <h4 class="page-title">Import</h4>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-lg-6">

            <div class="card">
                <div class="card-body">
                    <form action="{{route('products.importsubmit')}}" method="post" enctype="multipart/form-data" class="parsley-examples">
                        @csrf
                        <div class="mb-3">

                            <input type="file" name="upload_file" parsley-trigger="change" value="" class="form-control"  />
                        </div>



                        <div class="text-end">
                            <button class="btn btn-primary waves-effect waves-light" type="submit">Submit</button>
                            <button type="reset" class="btn btn-secondary waves-effect">Cancel</button>
                        </div>
                    </form>
                </div>
            </div> <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
@endsection
