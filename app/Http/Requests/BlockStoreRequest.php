<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlockStoreRequest extends FormRequest
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
            'name' => 'required|string|max:80',
            'society' => 'required|integer',
            'total_flats' => 'required|integer',
            'description' => 'required|string|max:600',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
            'society.required' => 'Society field is required!',
            'total_flats.required' => 'Total Flats is required!',
            'description.required' => 'Description is required!'
        ];
    }
}
