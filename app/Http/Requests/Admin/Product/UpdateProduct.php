<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateProduct extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.product.edit', $this->product);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string'],
            'spu' => ['sometimes', 'string'],
            'price' => ['sometimes', 'numeric'],
            'market_price' => ['nullable', 'numeric'],
            'promote_price' => ['nullable', 'numeric'],
            'is_on_sale' => ['sometimes', 'boolean'],
            'is_promote' => ['nullable', 'boolean'],
            'description' => ['nullable', 'string'],
            'details' => ['nullable', 'string'],
            'category_id' => ['nullable', 'string'],
            'brand_id' => ['nullable', 'string'],
            
        ];
    }

    /**
     * Modify input data
     *
     * @return array
     */
    public function getSanitized(): array
    {
        $sanitized = $this->validated();


        //Add your code for manipulation with request data here

        return $sanitized;
    }
}
