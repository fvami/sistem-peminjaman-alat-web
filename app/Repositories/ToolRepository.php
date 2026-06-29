<?php

namespace App\Repositories;

use App\Models\Tool;
use App\Repositories\Contracts\ToolRepositoryInterface;

class ToolRepository implements ToolRepositoryInterface
{
    public function all()
    {
        return Tool::with('category')->get();
    }

    public function find(Tool $tool)
    {
        return $tool;
    }

    public function create(array $data): Tool
    {
        return Tool::create($data);
    }

    public function update(Tool $tool, array $data): Tool
    {
        $tool->update($data);
        return $tool;
    }

    public function delete(Tool $tool)
    {
        $tool->delete();
    }
}
