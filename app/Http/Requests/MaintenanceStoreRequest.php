<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaintenanceStoreRequest extends FormRequest
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
            'type' => 'required',
            'society' => 'required|integer',
            'block' => 'required|integer',
            'plot' => 'required|integer',
            'flat' => 'required|integer',
            'type' => 'required',
            'date' => 'required',
            'year' => 'required',
            'month' => 'required',
            'amount' => 'required',
            'payment_status' => 'required',
            'description' => 'required|string|max:600',
        ];
    }

    public function attributes()
    {
        return [
            'payment_status' => 'Payment Status',
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
}
