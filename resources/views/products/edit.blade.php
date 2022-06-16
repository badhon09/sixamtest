@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<div class="row">
   <div class="col-12">
      <div class="page-title-box">
         <div class="page-title-right">
            <ol class="breadcrumb m-0">
               <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
               <li class="breadcrumb-item"><a href="javascript: void(0);">Products</a></li>
               <li class="breadcrumb-item"><a href="javascript: void(0);">Edit</a></li>
            </ol>
         </div>
         <h4 class="page-title">Edit Product</h4>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-body">
            <form action="{{route('products.update')}}" method="post" id="product_form" enctype="multipart/form-data" class="parsley-examples">
               @csrf
               <div class="row">
                  <div class="col-md-12 mb-2">
                     <label  class="form-label">Product Name<span class="text-danger">*</span></label>
                     <input type="text" name="name" parsley-trigger="change"  value="{{$product->name}}" class="form-control"  />
                     <input type="hidden" name="product_id"  value="{{$product->product_id}}" class="form-control"  />
                  </div>
                  <div class="col-md-12 mb-2">
                     <label  class="form-label">Product Description<span class="text-danger">*</span></label>
                     <input type="text" name="description" parsley-trigger="change" value="{{$product->description}}" class="form-control"  />
                  </div>
                  <div class="col-md-12 mb-2">
                    <label  class="form-label">Feature Image<span class="text-danger"></span></label>
                    <input type="file" name="image" parsley-trigger="change" value="{{$product->image}}" class="form-control"  />
                 </div>
               </div>
               <div class="row mb-2">
                  <div class="col-md-4">
                     <label  class="form-label">Product Category<span class="text-danger">*</span></label>
                     <select name="category" id="" class="form-control">
                        <option value="">select category</option>
                        @foreach ($categories as $category)
                        <option value="{{$category->category_id}}" {{ ( $category->category_id == $product->category_id) ? 'selected' : '' }}>{{$category->category_name}}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="col-md-4">
                     <label  class="form-label">Brand<span class="text-danger">*</span></label>
                     <select name="brand" id="" class="form-control">
                        <option value="">select brand</option>
                        @foreach ($brands as $brand)
                        <option value="{{$brand->brand_id}}" {{ ( $brand->brand_id == $product->brand_id) ? 'selected' : '' }}>{{$brand->brand_name}}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="col-md-4">
                     <label  class="form-label">Unit<span class="text-danger">*</span></label>
                     <select name="unit" id="" class="form-control">
                        <option value="">select unit</option>
                        <option value="pc" {{ ( "pc" == $product->unit) ? 'selected' : '' }}>Pcs</option>
                        <option value="kg" {{ ( "kg" == $product->unit) ? 'selected' : '' }}>Kg</option>
                     </select>
                  </div>
               </div>

               <div class="row">
                  <h4>Variations</h4>
                  <div class="row">
                     <div class="col-md-6 mb-3">
                        <label class="form-label">Colors :</label>
                        @if(!empty($product->colors))
                        <input type="checkbox"  name="c_active" data-switchery="true" data-plugin="switchery" data-color="#039cfd" checked>
                        @else
                        <input type="checkbox"  name="c_active" data-switchery="true" data-plugin="switchery" data-color="#039cfd" >
                        @endif
                        <div id="block">

                           <select
                              class="js-example-basic-multiple js-states js-example-responsive form-control color-var-select"
                              name="colors[]" multiple="multiple" id="colors-picker" >
                              @foreach (\App\Models\Color::get() as $key => $color)
                              <option value="{{ @$color->code }}" @if ($product->colors!=null)
                                {{in_array(@$color->code,json_decode($product->colors , true))?'selected':''}}
                              @endif >
                                 {{$color['name']}}
                              </option>
                              @endforeach
                           </select>
                        </div>

                        <div class="clearfix"></div>
                     </div>
                     <div class="col-md-6 mb-3">
                        <label class="form-label">Variation Attributes</label>

                        <div class="row">
                           <a onclick="variation()" class="btn btn-primary">Add Variations</a>
                        </div>

                     </div>
                  </div>
                  <div class="row ml-2 mr-2">
                     <div class="col-md-12 mt-2 mb-2">
                        <div class="option_div" id="option_div">
                            @if($product->is_variant==1)
                            <div class="row" id="addnew">
                                <h6>variations</h6>

                                {{-- <select name="variation_name[]" class="form-control col-md-2 mr-1" id="">
                                <option value="size">Size</option>
                                <option value="color">Color</option>
                                </select> --}}
                                <div class="row">
                                    <div class="col-md-3">
                                        @foreach(explode(',',rtrim(json_decode($product->variation_name), ',')) as $fields)
                                        <input type="text" name="variation_name[]" required class="form-control mr-1" value="{{$fields}}">
                                        @endforeach
                                    </div>
                                    <div class="col-md-3">
                                        @foreach(explode(',',rtrim(json_decode($product->variation_options), ',')) as $fields)
                                        <input type="text" name="variation_options[]" required class="form-control mr-1" value="{{$fields}}">
                                        @endforeach
                                    </div>
                                    <div class="col-md-3">
                                        @foreach(explode(',',rtrim(json_decode($product->variation_price), ',')) as $fields)
                                        <input type="text" name="variation_price[]"  required class="form-control  mr-1" value="{{$fields}}">
                                        @endforeach
                                    </div>
                                    <div class="col-md-3">
                                        @foreach(explode(',',rtrim(json_decode($product->variation_quantity), ',')) as $fields)
                                        <input type="text" name="variation_quantity[]" required class="form-control " value="{{$fields}}">
                                        @endforeach
                                    </div>
                                </div>




                            </div>
                                @endif
                        </div>
                     </div>
                  </div>
               </div>
               {{-- <div class="row">
                  <div class=" col-12 pro_list" id="pro_list"></div>
               </div> --}}
               <div class="row">
                  <h4>Price and Stock</h4>
                  <div class="col-md-6">
                     <label for="userName" class="form-label">Unit Price<span class="text-danger"></span></label>
                     <input type="text" name="unit_price" parsley-trigger="change"  value="{{$product->unit_price}}" class="form-control"  />
                  </div>
                  <div class="col-md-6">
                     <label for="userName" class="form-label">Purchase Price<span class="text-danger"></span></label>
                     <input type="text" name="purchase_price" parsley-trigger="change" value="{{$product->purchase_price}}" class="form-control"  />
                  </div>
                  <div class="col-md-6">
                     <label for="userName" class="form-label">Total Quantty<span class="text-danger"></span></label>
                     <input type="text" name="quantity" parsley-trigger="change"  value="{{$product->quantity}}" class="form-control"  />
                  </div>
               </div>
               <div class="text-end">
                  {{-- <button class="btn btn-primary waves-effect waves-light" type="submit" >Submit</button> --}}
                  <a class="btn btn-primary waves-effect waves-light" onclick="update()" >Submit</a>
                  <button type="reset" class="btn btn-secondary waves-effect">Cancel</button>
               </div>
            </form>
         </div>
      </div>
      <!-- end card -->
   </div>
   <!-- end col -->
</div>
<!-- end row -->
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@push('custom-scripts')


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js" integrity="sha512-MqEDqB7me8klOYxXXQlB4LaNf9V9S0+sG1i8LtPOYmHqICuEZ9ZLbyV3qIfADg2UJcLyCm4fawNiFvnYbcBJ1w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
   $(document).ready(function () {
       $('.js-example-basic-multiple').select2();
      // $("#block").attr('hidden',true);

       $('input[name="c_active"]').on('change', function () {
           if (!$('input[name="c_active"]').is(':checked')) {
               $("#block").attr('hidden',true);

               //$('#color_picker').attr('disabled', true);

           } else {
               $("#block").attr('hidden',false);
           }
       });





   })



function variation(){

   $('#option_div').append(`<div class="row" id="addnew">
   <h6>variations</h6>
   <select name="variation_name[]" class="form-control col-md-2 mr-1" id="">
   <option value="size">Size</option>
   <option value="color">Color</option>
   </select>
   <input type="text" name="variation_options[]" required class="form-control col-md-3 mr-1" placeholder="Size or Color">
   <input type="text" name="variation_price[]"  required class="form-control col-md-3 mr-1" placeholder="price">
   <input type="text" name="variation_quantity[]" required class="form-control col-md-3" placeholder="quantity">
   </div>`)

}


function update() {
      //swal("Hello world!");
     // $('#btn').attr('disabled', true);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //alert( $('#product_form').serialize())

            $.ajax({
                type: "POST",
                url: '{{route('products.update')}}',
                data: $('#product_form').serialize(),

                success: function (data) {


                        if (data.errors) {
                           // alert("ksjsj")


                            for (var i = 0; i < data.errors.length; i++) {


                                //alert(data.errors[i].message)

                                toastr.error(data.errors[i].message, {
                                    CloseButton: true,
                                    ProgressBar: true
                                });
                            }
                        } else {
                            swal("product Updated")
                            var url = '{{route("products.index") }}';

                            window.location.href = url;

                        }
                    }
            });
        }
</script>
@endpush
