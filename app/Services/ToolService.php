<?php

namespace App\Services;

use App\Models\Tool;
use App\Repositories\ToolRepository;
use Illuminate\Http\UploadedFile;

class ToolService
{
    public function __construct(
        protected ToolRepository $toolRepository,
        protected FileStorageService $fileStorage
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
        $shouldDeleteImage = $tool->image_remove == 1;

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
