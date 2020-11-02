<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaleRequest extends FormRequest
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
            'bank_name' => 'required',
            'branch_name' => 'required',
            'bank_number' => 'required',
            'account_holder' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'bank_name' => '銀行名',
            'branch_name' => '支店名',
            'bank_number' => '口座番号',
            'account_holder' => '口座名義',
        ];
    }
}
