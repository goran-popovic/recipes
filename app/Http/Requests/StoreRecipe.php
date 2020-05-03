<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRecipe extends FormRequest
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
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'ingredients' => ['required', 'string'],
            'category_id' => ['required', 'min:1', 'max:100', 'integer'],
            'images.*' => ['required', 'mimes:jpeg,jpg,png'],
        ];
    }
}
