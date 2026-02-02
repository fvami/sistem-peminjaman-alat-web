<?php

namespace App\Http\Controllers;

use App\Http\Resources\ToolResource;
use App\Models\Category;
use App\Models\Tool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ToolController extends Controller
{
    public function index()
    {
        $tool = Tool::all();
        $category = Category::all();
        return view('admin.pages.tool.index', compact('tool', 'category'));
    }

    public function tool()
    {
        $tools = Tool::with('category')->get();

        $data = $tools->map(function ($tool) {
            return [
                'id' => $tool->id,
                'name' => $tool->name,
                'description' => $tool->description,
                'stock' => $tool->stock,
                'status' => $tool->status,
                'category' => $tool->category->name ?? '-',
                'image_url' => $tool->image ? asset('storage/' . $tool->image) : null
            ];
        });

        return response()->json(['data' => $data]);
    }


    public function show($id)
    {
        $data = Tool::findOrFail($id);
        return new ToolResource($data);
    }

    public function store(Request $req)
    {
        $data = $req->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'stock' => 'nullable|integer|min:0',
            'status' => 'nullable|in:available,unavailable,maintenance',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
        ]);

        if ($req->hasFile('image')) {
            $data['image'] = $req->file('image')->store('tools', 'public');
        }

        $tool = Tool::create($data);

        return new ToolResource($tool);
    }


    public function update(Request $req, $id)
    {
        $tool = Tool::findOrFail($id);

        $data = $req->validate([
            'name'        => 'required',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'stock'       => 'nullable|integer|min:0',
            'status'      => 'nullable|in:available,unavailable,maintenance',
            'image'       => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
        ]);

        if ($req->hasFile('image')) {
            if ($tool->image) {
                Storage::disk('public')->delete($tool->image);
            }

            $data['image'] = $req->file('image')->store('tools', 'public');
        } elseif ($req->remove_image == 1) {
            if ($tool->image) {
                Storage::disk('public')->delete($tool->image);
            }

            $data['image'] = null;
        }

        $tool->update($data);

        return new ToolResource($tool);
    }

    public function delete($id)
    {
        $tool = Tool::findOrFail($id);
        if ($tool->image) {
            if (Storage::disk('public')->exists($tool->image)) {
                Storage::disk('public')->delete($tool->image);
            }
        }
        $tool->delete();

        return response()->json('Success Deleted!');
    }
}
