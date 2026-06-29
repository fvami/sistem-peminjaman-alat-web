<?php

namespace App\Services;

use App\Services\Contracts\FileStorageInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileStorageService implements FileStorageInterface
{
    protected string $disk = 'public';

    public function upload(UploadedFile $file, string $directory): string
    {
        return $file->store($directory, $this->disk);
    }

    public function delete(?string $path): void
    {
        if ($path && Storage::disk($this->disk)->exists($path)) {
            Storage::disk($this->disk)->delete($path);
        }
    }
}
