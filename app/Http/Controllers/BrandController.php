<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $data = Brand::brands();
        return view('brand.index', compact('data'));
    }
    public function add()
    {
        $addEdit = 'add';
        
        $categories = Category::categories();
        return view('brand.addEdit', compact('addEdit', 'categories'));
    }
    public function getTable()
    {
        $table = (new Brand)->getNewTabless();
    }
}
