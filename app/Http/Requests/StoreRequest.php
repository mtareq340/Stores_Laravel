<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'country_id' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',

        ];
    }
    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'string' => 'هذا الحقل يجب ان يكون حروف',
            'email' => 'هذا الحقل يجب ان يكون بريد الكتروني',
            'unique' => 'هذا البريد موجود من قبل',
            'name.max' => 'اسم القسم لا يزيد عن 100 حرف',
        ];
    }
}
