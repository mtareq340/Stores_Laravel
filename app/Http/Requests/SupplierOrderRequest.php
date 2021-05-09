<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierOrderRequest extends FormRequest
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
            'mainproducts' => 'required|array',
            'total_price' => 'required|numeric',
            'paid_price' => 'required|numeric',
            'remaining_price' => 'required|numeric',
        ];
    }
    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'string' => 'هذا الحقل يجب ان يكون حروف',
            'numeric' => 'هذا الحقل يجب ان يكون رقم',
            'name.max' => 'اسم القسم لا يزيد عن 100 حرف',
        ];
    }
}
