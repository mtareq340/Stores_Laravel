<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // admin guard
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
            'abbr' => 'required|string|max:10',
            'active' => 'in:0,1',
            'direction' => 'required|in:rtl,ltr',
        ];
    }
    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'string' => 'هذا الحقل يجب ان يكون حروف',
            'name.max' => 'اسم اللغة لا يزيد عن 100 حرف',
            'abbr.max' => 'هذا الحقل لا يزيد عن 10 احرف',
            'in' => 'القيم المدخلة غير صحيحة',
        ];
    }
}
