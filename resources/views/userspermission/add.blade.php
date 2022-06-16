@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Permission</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Set</a></li>
                    </ol>
                </div>
                <h4 class="page-title">Set Permission</h4>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-lg-6">

            <div class="card">
                <div class="card-body">
                    <form action="{{route('permission.store')}}" method="post" class="parsley-examples">
                        @csrf
                        <div class="mb-3">

                            <input type="hidden" name="user_id" parsley-trigger="change" value="{{$id}}" class="form-control"  />
                        </div>

                        <div class="table table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Menus</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($permissions) > 0)
                                    @foreach($permissions as $key => $permission)
                                        <tr>
                                            <td>{{str_replace('_', ' ', Str::title($permission->header_name))}}</td>
                                            <td><input type="checkbox" name="{{$permission->header_id}}" value="{{$permission->header_id}}" @if(in_array($permission->header_id,$rolePermission->pluck('permission_id')->toArray())) checked @endif></td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
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
