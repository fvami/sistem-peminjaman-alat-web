<?php

namespace App\Repositories\Contracts;

use App\Models\Tool;

interface ToolRepositoryInterface
{
    public function all();
    public function find(Tool $tool);
    public function findById(int $id): ?Tool;
    public function findForUpdate(int $id): ?Tool;
    public function decrementStock(Tool $tool, int $qty): void;
    public function create(array $data): Tool;
    public function update(Tool $tool, array $data): Tool;
    public function delete(Tool $tool);
}
