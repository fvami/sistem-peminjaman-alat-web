<?php

namespace App\Services;

use App\Exceptions\CartException;
use App\Models\Tool;
use App\Repositories\Contracts\CartRepositoryInterface;
use App\Repositories\Contracts\ToolRepositoryInterface;

class CartService
{
    public function __construct(
        protected CartRepositoryInterface $cartRepository,
        protected ToolRepositoryInterface $toolRepository
    ) {}

    public function getCart(): array
    {
        return $this->cartRepository->get();
    }

    public function add(int $toolId): array
    {
        $cart = $this->cartRepository->get();
        $tool = $this->toolRepository->findById($toolId);

        $this->ensureToolAvailable($tool);

        $currentQty = $cart[$tool->id]['qty'] ?? 0;

        if ($tool->stock < ($currentQty + 1)) {
            throw new CartException('Stok tidak mencukupi!');
        }

        if (isset($cart[$tool->id])) {
            $cart[$tool->id]['qty']++;
        } else {
            $cart[$tool->id] = ['tool_id' => $tool->id, 'name' => $tool->name, 'qty' => 1];
        }

        $this->cartRepository->save($cart);
        return $cart;
    }

    public function updateQty(int $toolId, int $qty): array
    {
        $cart = $this->cartRepository->get();
        $tool = $this->toolRepository->findById($toolId);

        $this->ensureToolAvailable($tool);

        $requestedQty = max(1, $qty);

        if ($tool->stock < $requestedQty) {
            throw new CartException('Hanya tersedia ' . $tool->stock . ' unit.', ['max_stock' => $tool->stock]);
        }

        if (isset($cart[$tool->id])) {
            $cart[$tool->id]['qty'] = $requestedQty;
        }

        $this->cartRepository->save($cart);
        return $cart;
    }

    public function remove(int $toolId): array
    {
        $cart = $this->cartRepository->get();
        unset($cart[$toolId]);
        $this->cartRepository->save($cart);
        return $cart;
    }

    protected function ensureToolAvailable(?Tool $tool): void
    {
        if (!$tool || $tool->status !== 'available') {
            throw new CartException('Alat tidak tersedia atau sudah tidak aktif.');
        }
    }
}
