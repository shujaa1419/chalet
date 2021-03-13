<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);
        return view('backend.categories.index',compact('categories'));
    }

    public function create()
    {
        return view('backend.categories.create');
    }

    public function store(Request $request)
    {
        $validator =Validator::make($request->all(),[
            'name' => 'required|max:20|unique:cities'
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data['name'] = $request->name;
        Category::create($data);
        return redirect()->route('dashboard.categories.index')->with([
            'message' => 'Category Created successfully',
            'alert-type' => 'success'
        ]);
    }

    public function edit(Category $category)
    {
        return view('backend.categories.edit',compact('category'));

    }

    public function update(Request $request,Category $category)
    {
        $validator =Validator::make($request->all(),[
            'name' => 'required|max:20|unique:cities'
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data['name'] = $request->name;
        $category->update($data);
        return redirect()->route('dashboard.categories.index')->with([
            'message' => 'Category updated successfully',
            'alert-type' => 'success',
        ]);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('dashboard.categories.index')->with([
            'message' => 'Category deleted successfully',
            'alert-type' => 'success',
        ]);
    }
}
