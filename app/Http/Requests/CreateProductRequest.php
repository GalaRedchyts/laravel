<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() && isAdmin(auth()->user());
    }

    public function messages()
    {
        return [
            'title' => 'Title should be more than 3 symbols',
            'description' => 'Description should be more than 20 symbols',
            'short_description' => 'Short description must be no more than 150 symbols',
            'SKU' => 'SKU should be more than 2 symbols',
            'price' => 'Price should be more than 2 symbols',
            'discount' => 'Discount must be no more than 99%',
            'thumbnail' => 'Image should be format jpeg and png',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'min:3', 'unique:products'],
            'description' => ['required', 'string', 'min:20'],
            'short_description' => ['required', 'string', 'min:20', 'max:150'],
            'SKU' => ['required', 'string', 'min:2', 'unique:products'],
            'price' => ['required', 'numeric', 'min:2'],
            'discount' => ['required', 'numeric', 'min:0', 'max:99'],
            'in_stock' => ['required', 'numeric', 'min:0'],
            'category' => ['required', 'numeric'],
            'thumbnail' => ['required', 'image:jpeg,png'],
        ];
    }
}
