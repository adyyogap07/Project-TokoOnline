<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:255',
            'categories_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'description' => 'required'
            // user_id tidak perlu divalidasi karena diisi otomatis
        ];
    }

}
