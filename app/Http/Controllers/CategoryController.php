<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Illuminate\Support\Facades\Log;


class CategoryController extends Controller
{
    public function index()
    {
        $data = Category::categories();
        return view('category.index', compact('data'));
    }
    public function add()
    {
        $addEdit = 'add';
        return view('category.addEdit', compact('addEdit'));
    }
    public function store(Request $request)
    {
        if(Category::duplicateCheck('name', $request->name))
        {
            return redirect()->back()->with('error', Category::$duplicate_entry_message);
        }  
        $result = Category::store($request);
        if($result == Category::$success)
        {
            $message = "Category data insert successfully by ".Auth::user()->name.'('.Auth::user()->id.'), table name = categories, at '.date('Y-m-d H:i:s', time());
            Log::info($message);
            return redirect()->back()->with('success', Category::$success_message);
        }
    }
    public function edit($id)
    {
        $data = array(
            'category' => Category::category($id),
            'addEdit' => 'edit'
        );

        return view('category.addEdit', $data);
    }
    public function update(Request $request)
    {
        $result = Category::updateCategory($request);
        if($request)
        {
            return redirect()->back()->with('success', Category::$update_success_message);
        }
    }
    public function delete($id)
    {
        $result = Category::deleteCategory($id);
        if($result)
        {
            return redirect()->route('category')->with('error', Category::$delete_success_message);
        }
    }
}
