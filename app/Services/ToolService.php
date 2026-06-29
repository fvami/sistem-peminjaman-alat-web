<?php

namespace App\Services;

use App\Models\Tool;
use App\Repositories\Contracts\ToolRepositoryInterface;
use App\Services\Contracts\FileStorageInterface;
use Illuminate\Http\UploadedFile;

class ToolService
{
    public function __construct(
        protected ToolRepositoryInterface $toolRepository,
        protected FileStorageInterface $fileStorage
    ) {}

    public function getAll()
    {
        return $this->toolRepository->all();
    }

    public function getDetail(Tool $tool): Tool
    {
        return $this->toolRepository->find($tool);
    }

    public function store(array $data): Tool
    {
        if (isset($data['image'])) {
            $data['image'] = $this->fileStorage->upload($data['image'], 'tools');
        }

        $tool = $this->toolRepository->create($data);
        return $this->toolRepository->find($tool);
    }

    public function update(Tool $tool, array $data): Tool
    {
        $hasNewImage = isset($data['image']) && $data['image'] instanceof UploadedFile;
        $shouldDeleteImage = !empty($data['remove_image']);

        if ($hasNewImage) {
            $this->fileStorage->delete($tool->image);
            $data['image'] = $this->fileStorage->upload($data['image'], 'tools');
        } elseif ($shouldDeleteImage) {
            $this->fileStorage->delete($tool->image);
            $data['image'] = null;
        }

        $tool = $this->toolRepository->update($tool, $data);
        return $this->toolRepository->find($tool);
    }

    public function delete(Tool $tool)
    {
        $this->fileStorage->delete($tool->image);
        $this->toolRepository->delete($tool);
    }
}
