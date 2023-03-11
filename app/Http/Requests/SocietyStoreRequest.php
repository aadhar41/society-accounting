<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SocietyStoreRequest extends FormRequest
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
            'contact' => 'required|integer|digits:10',
            'postcode' => 'required|integer|digits:6',
            'country' => 'required|integer',
            'state' => 'required|integer',
            'city' => 'required|integer',
            'address' => 'required|string|max:250',
            'description' => 'required|string|max:500',
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
            'contact.required' => 'Contact is required!',
            'postcode.required' => 'Post Code is required!',
            'country.required' => 'Country is required!',
            'state.required' => 'State is required!',
            'city.required' => 'City is required!',
            'address.required' => 'Address is required!',
            'description.required' => 'description is required!'
        ];
    }
}
