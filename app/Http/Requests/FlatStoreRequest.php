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
            'name.required' => 'Name is required!',
            'flat_no.required' => 'Flat No is required!',
            'description.required' => 'Description is required!',
            'mobile_no.required' => 'Mobile No field is required!',
            'property_type.required' => 'Property Type field is required!',
            'tenant_name.required' => 'Tenant Name is required!',
            'tenant_contact.required' => 'Tenant Contact is required!',
        ];
    }
}
