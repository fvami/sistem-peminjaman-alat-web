<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ToolResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'category' => optional($this->category)->name ?? '-',
            'category_id' => $this->category_id,
            'description' => $this->description,
            'stock'       => $this->stock,
            'status'      => $this->status,
            'image_url' => $this->image ? url('storage/' . $this->image) : null,
            // 'created_at'  => $this->created_at,
            // 'updated_at'  => $this->updated_at,
        ];
    }
}
