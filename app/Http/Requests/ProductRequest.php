<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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


    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:255',
            'price' => 'required',
            'manufacturer' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'model_no' => 'required|string|max:255',
            'mdma_no' => 'required|string|max:255',
            'description' => 'required|string',

            'files' => 'required|array|min:1',
            'files.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',


            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_id' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The product name is required.',
            'category_id.required' => 'The Category is required.',
            'subcategory_id.required' => 'The Sub-Category ID is required.',
            'subsubcategory_id.required' => 'The Sub-Sub-Category is required.',


            'price.required' => 'Price is required.',
            'manufacturer.required' => 'Manufacturer is required.',
            'country.required' => 'Country is required.',
            'price.numeric' => 'Price must be a valid number.',
            'files.required' => 'At least one image is required.',
            'files.min' => 'You must upload at least one image.',
            'files.*.image' => 'Each file must be a valid image.',
            'files.*.mimes' => 'Only JPEG, PNG, JPG, GIF, and SVG formats are allowed.',
            'files.*.max' => 'Each image must be less than 2MB.',
        ];
    }

}
