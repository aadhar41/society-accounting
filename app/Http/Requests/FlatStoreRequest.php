<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FlatStoreRequest extends FormRequest
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
            'flat_no' => 'required|integer',
            'description' => 'required|string|max:600',
            'mobile_no' => 'required|integer',
            'property_type' => 'required|string',
            'tenant_name' => 'required|string|max:80',
            'tenant_contact' => 'required|integer',
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
            "*.required" => "The :attribute field cannot be empty.",
        ];
    }


    public function attributes()
    {
        return [
            'flat_no' => 'Flat Number',
            'mobile_no' => 'Mobile Number',
            'property_type' => 'Property Type',
            'tenant_name' => 'Tenant Name',
            'tenant_contact' => 'Tenant Contact',
        ];
    }
}
