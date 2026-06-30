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

    public function findById(int $id): ?Tool
    {
        return Tool::find($id);
    }

    public function findForUpdate(int $id): ?Tool
    {
        return Tool::lockForUpdate()->find($id);
    }

    public function decrementStock(Tool $tool, int $qty): void
    {
        $tool->decrement('stock', $qty);
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
