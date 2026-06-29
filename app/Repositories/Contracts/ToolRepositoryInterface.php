<?php

namespace App\Repositories\Contracts;

use App\Models\Tool;

interface ToolRepositoryInterface
{
    public function all();
    public function find(Tool $tool);
    public function create(array $data): Tool;
    public function update(Tool $tool, array $data): Tool;
    public function delete(Tool $tool);
}
