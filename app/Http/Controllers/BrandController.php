<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
    public function store(Request $request)
    {
        if(Brand::duplicateCheck('name', $request->name))
        {
            return redirect()->back()->with('error', Brand::$duplicate_entry_message);
        }  
        $result = Brand::store($request);
        if($result == Brand::$success)
        {
            $message = "Brand data insert successfully by ".Auth::user()->name.'('.Auth::user()->id.'), table name = categories, at '.date('Y-m-d H:i:s', time());
            Log::info($message);
            return redirect()->back()->with('success', Brand::$success_message);
        }
    }

    public function edit($id)
    {
        $data = array(
            'brand' => Brand::brand($id),
            'addEdit' => 'edit'
        );

        return view('brand.addEdit', $data);
    }
    public function update(Request $request)
    {
        if(Brand::updateDuplicateCheck('name', $request->name, $request->id))
        {
            return redirect()->back()->with('error', Brand::$duplicate_entry_message);
        } 

        $result = Brand::updateBrand($request);
        if($request)
        {
            return redirect()->back()->with('success', Brand::$update_success_message);
        }
    }
    public function delete($id)
    {
        $result = Brand::deleteBrand($id);
        if($result)
        {
            return redirect()->route('brand')->with('error', Brand::$delete_success_message);
        }
    }
}
