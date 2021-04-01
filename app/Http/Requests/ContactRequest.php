<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactRequest extends FormRequest
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
            'name' => 'required',
            'type' => 'required',
            'email' => 'required|email',
            'content' => 'required',
        ];
    }

    public function attributes()
    {
        return [
			'name' => 'お名前',
			'type' => 'ユーザー種別',
			'email' => 'メールアドレス',
			'content' => '内容',
        ];
    }
}
