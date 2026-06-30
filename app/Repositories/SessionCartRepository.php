<?php

namespace App\Repositories;

use App\Repositories\Contracts\CartRepositoryInterface;

class SessionCartRepository implements CartRepositoryInterface
{
    public function get(): array
    {
        return session('cart', []);
    }

    public function save(array $cart): void
    {
        session(['cart' => $cart]);
    }

    public function clear(): void
    {
        session()->forget('cart');
    }
}
