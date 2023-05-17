<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStorePostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required',
            'original_price' => ['required', 'regex:/^\d+(\.\d{1,10})?$/'],
            'qty' => 'required|numeric|min:1',
            'trending' => 'required|numeric|min:1'
        ];
    }
    
    public function messages(): array
    {
        return [
            'original_price.regex' => 'The price field format is invalid. Must be decimal.'            
        ];
    }
}
