<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $data = Category::all();
        return view('admin.pages.category.index',compact('data'));
    }

    public function category()
    {
        $data = Category::all();
        return response()->json(['data' => $data]);
    }

    public function show($id)
    {
        $data = Category::findOrfail($id);
        return response()->json(['data' => $data]);
    }

    public function store(Request $req)
    {
        $validated = $req->validate([
            'name' => ['required']
        ]);
        $data = Category::create($validated);
        return response()->json(['data' => $data]);
    }

    public function update(Request $req, $id)
    {
        $data = Category::findOrfail($id);
        $data->update($req->all());
        return response()->json(['data' => $data]);
    }

    public function delete($id)
    {
        $data = Category::findOrfail($id);
        $data->delete();
        return response()->json(['Deleted Success!']);
    }
}
