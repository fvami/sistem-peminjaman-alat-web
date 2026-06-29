<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreToolRequest;
use App\Http\Requests\UpdateToolRequest;
use App\Http\Resources\ToolResource;
use App\Models\Category;
use App\Models\Tool;
use App\Services\ToolService;

class ToolController extends Controller
{
    public function __construct(
        protected ToolService $toolService
    ) {}

    public function index()
    {
        $tool = Tool::all();
        $category = Category::all();
        return view('admin.pages.tool.index', compact('tool', 'category'));
    }

    public function tool()
    {
        return ToolResource::collection($this->toolService->getAll());
    }


    public function show(Tool $tool)
    {

        return new ToolResource($this->toolService->getDetail($tool));
    }

    public function store(StoreToolRequest $req)
    {
        $tool = $this->toolService->store($req->validated());
        return new ToolResource($tool);
    }


    public function update (Tool $tool, UpdateToolRequest $req)
    {
        $tool = $this->toolService->update($tool, $req->validated());
        return new ToolResource($tool);
    }

    public function delete(Tool $tool)
    {
        $this->toolService->delete($tool);
        return response()->json('Success Deleted!');
    }
}
