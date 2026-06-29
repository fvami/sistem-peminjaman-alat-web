<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreToolRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'stock' => 'nullable|integer|min:0',
            'status' => 'nullable|in:available,unavailable,maintenance',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
        ];
    }
}
