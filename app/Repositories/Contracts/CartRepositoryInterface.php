<?php

namespace App\Repositories\Contracts;

interface CartRepositoryInterface
{
    public function get(): array;
    public function save(array $cart): void;
    public function clear(): void;
}
