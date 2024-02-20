<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
			'unit_id' => 'required|exists:App\Models\Unit,id',
			'price' => 'required|numeric',
			'stock' => 'required|numeric',
			'description' => 'nullable|string',
			'image' => 'nullable|image|max:1024',
        ];
    }
}
