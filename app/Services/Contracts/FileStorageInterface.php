<?php

namespace App\Services\Contracts;

use Illuminate\Http\UploadedFile;

interface FileStorageInterface
{
    public function upload(UploadedFile $file, string $directory): string;
    public function delete(?string $path): void;
}
