<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BrandController extends Controller
{
    function index(){
        return view('brands.index');
    }

    function brandlist(){
        //
    }

    function add(){
        return view('brands.add');
    }

    function store(){

    }


}
