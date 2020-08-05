<?php

namespace App\Http\Requests\Dashboard\Products;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];

        $rules += ['category_id' => 'required'];

        foreach (config('translatable.locales') as $locale) {
            $rules += [$locale . '.name' => [' required', Rule::unique('product_translations', 'name')->ignore($this->product->id, 'product_id')]];
            $rules += [$locale . '.desc' => 'required|min:3'];
        }

        $rules += [
            'image' => 'image',
            'purches_price' => 'required|numeric|min:1',
            'sale_price' => 'required|numeric|gt:purches_price',
            'stock' => 'required|numeric|min:0',
        ];

        return $rules;
    }
}
