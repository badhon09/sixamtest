<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use Datatable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Auth;
use Rap2hpoutre\FastExcel\FastExcel;
use DB;

use Intervention\Image\Facades\Image;


class ProductController extends Controller
{
    function index(){

        return view('products.index');
    }

    function productlist(Request $request){


        if($request->unit_price!=''){
            $products = Product::with('category','brand')->where('unit_price',$request->unit_price)->orwhere('purchase_price',$request->unit_price)->get();
        }else{
            $products = Product::with('category','brand');

        }


        return datatables()->of($products)

            ->addColumn('action', function($n) {
                $btn = '';
                if(Auth::user()->can('product_edit')){
                    $btn =$btn.'<a href="javascript:void(0)" class="btn btn-primary btn-sm"   onclick="editTeam('.$n->product_id.')" >Edit</a>';
                }
                if(Auth::user()->can('product_delete')){
                    $btn =$btn.'<a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="deleteTeam('.$n->product_id.')" ><i class="ft-eye"></i>Delete</a>';
                }
                return $btn;

            })
            ->rawColumns(['action'])
            ->setRowAttr([
                'align'=>'center',
            ])->make(true);


    }



    function add(){

        $brands = Brand::where('status',1)->get();
        $categories = Category::where('status',1)->get();
        return view('products.add',compact('brands','categories'));
    }


    function store(Request $request){


        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category' => 'required',
            'brand' => 'required',
            'unit' => 'required',
            //'image' => 'required|mimes:jpg,jpeg,png,bmp,tiff |max:4096',

        ], [
            'name.required' => 'Product Name  is required!',
            'category.required' => 'category  is required!',
            'brand.required' => 'brand  is required!',
            'unit.required' => 'Unit  is required!',
            //'image.required' => 'Please insert image only!',
        ]);

        if ($validator->errors()->count() > 0) {
            return response()->json(['errors' => $this->error_handle($validator)]);
        }




        $attributes       = '';
        $variation_names   = '';
        $variation_quantitys = '';
        $variation_prices = '';
        $variation_optionss = '';

        if(!empty($request->variation_name)){
        for ($i = 0; $i < count($request->variation_name); $i++) {
           // $attributes       .= $request->attribute[$i] . ',';
            $variation_names   .= $request->variation_name[$i] . ',';
            $variation_prices .= $request->variation_price[$i] . ',';
            $variation_quantitys .= $request->variation_quantity[$i] . ',';
            $variation_optionss .= $request->variation_options[$i] . ',';
        }
    }

        // $aa=  json_encode($variation_names);
        // return json_decode($aa);

        $product = new Product;

        $product->name             = $request->name;
        $product->description      = $request->description;
        $product->slug             = Str::slug($request->name);
        $product->category_id      = $request->category;
        $product->brand_id         = $request->brand;
        $product->unit             = $request->unit;
        $product->unit_price       =$request->unit_price;
        $product->purchase_price   = $request->purchase_price;
        $product->quantity         = $request->quantity;
        $product->colors           = json_encode($request->colors);
        if(!empty($variation_names)){
            $product->is_variant   = 1;
            $product->variation_name   = json_encode($variation_names);
            $product->variation_price   = json_encode($variation_prices);
            $product->variation_quantity   = json_encode($variation_quantitys);
            $product->variation_options   = json_encode($variation_optionss);
        }



        if ($request->hasFile('image')) {
            $originalExtension = $request->image->getClientOriginalExtension();
            $uniqueImageName = rand(100, 999).'.'.$originalExtension;
            $image = Image::make($request->image);
            $image->save(public_path().'/productimages/'.$uniqueImageName);

            $product->image = $uniqueImageName;
            $product->save();



        }
        $product->save();




        return redirect()->route('products.index');


    }

    function update(Request $request){


        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category' => 'required',
            'brand' => 'required',
            'unit' => 'required',
            //'image' => 'required|mimes:jpg,jpeg,png,bmp,tiff |max:4096',

        ], [
            'name.required' => 'Product Name  is required!',
            'category.required' => 'category  is required!',
            'brand.required' => 'brand  is required!',
            'unit.required' => 'Unit  is required!',
            //'image.required' => 'Please insert image only!',
        ]);

        if ($validator->errors()->count() > 0) {
            return response()->json(['errors' => $this->error_handle($validator)]);
        }




        $attributes       = '';
        $variation_names   = '';
        $variation_quantitys = '';
        $variation_prices = '';
        $variation_optionss = '';

        if(!empty($request->variation_name)){
        for ($i = 0; $i < count($request->variation_name); $i++) {
           // $attributes       .= $request->attribute[$i] . ',';
            $variation_names   .= $request->variation_name[$i] . ',';
            $variation_prices .= $request->variation_price[$i] . ',';
            $variation_quantitys .= $request->variation_quantity[$i] . ',';
            $variation_optionss .= $request->variation_options[$i] . ',';
        }
    }

        // $aa=  json_encode($variation_names);
        // return json_decode($aa);

        $product = Product::find($request->product_id);
        $product->name             = $request->name;
        $product->description      = $request->description;
        $product->slug             = Str::slug($request->name);
        $product->category_id      = $request->category;
        $product->brand_id         = $request->brand;
        $product->unit             = $request->unit;
        $product->unit_price       =$request->unit_price;
        $product->purchase_price   = $request->purchase_price;
        $product->quantity         = $request->quantity;
        $product->colors           = json_encode($request->colors);
        if(!empty($variation_names)){
            $product->is_variant   = 1;
            $product->variation_name   = json_encode($variation_names);
            $product->variation_price   = json_encode($variation_prices);
            $product->variation_quantity   = json_encode($variation_quantitys);
            $product->variation_options   = json_encode($variation_optionss);
        }




        if ($request->hasFile('image')) {
            $originalExtension = $request->image->getClientOriginalExtension();
            $uniqueImageName = rand(100, 999).'.'.$originalExtension;
            $image = Image::make($request->image);
            $image->save(public_path().'/productimages/'.$uniqueImageName);

            $product->image = $uniqueImageName;
            $product->save();
        }
        $product->save();




        return redirect()->route('products.index');


    }

    public static function error_handle($validator)
    {
        $err_keeper = [];
        foreach ($validator->errors()->getMessages() as $index => $error) {
            array_push($err_keeper, ['code' => $index, 'message' => $error[0]]);
        }
        return $err_keeper;
    }

    function edit($id){
        $brands = Brand::where('status',1)->get();
        $categories = Category::where('status',1)->get();
        $product = Product::find($id);
        return view('products.edit',compact('product','categories','brands'));
    }

    function delete(Request $r){

      $delete = Product::find($r->id);
      $delete->delete();
        return true;
    }

    function import(Request $r){

        return view('products.import');
      }

      public function importsubmit(Request $request)
      {
          try {
              $collections = (new FastExcel)->import($request->file('upload_file'));
          } catch (\Exception $exception) {

              return "Wrong File Format";
          }


          $data = [];

          foreach ($collections as $collection) {

              array_push($data, [
                  'name' => $collection['name'],
                  'slug' => Str::slug($collection['name']),
                  'category_id' => $collection['category_id'],
                    'brand_id' => $collection['brand_id'],
                  'unit' => $collection['unit'],
                  'quantity' => $collection['quantity'],
                  'unit_price' => $collection['unit_price'],
                  'purchase_price' => $collection['purchase_price'],
                  'description' => $collection['details'],

              ]);
          }
          DB::table('products')->insert($data);

          return redirect()->route('products.index');
      }





}
