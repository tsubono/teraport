<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $rules = [
            'name' => 'required|max:255',
        ];

        switch($this->method())
        {
            case 'POST':
                {
                    $rules['email'] = 'required|email|unique:users,email';
                    $rules['password'] = 'required';
                }
            case 'PUT':
            case 'PATCH':
                {
                    $rules['email'] = ['required', 'email', Rule::unique('users','email')->ignore($this->id)];
                }
            default:break;
        }

        return $rules;
    }

    public function attributes()
    {
        return [
			'name' => '名前',
			'email' => 'メールアドレス',
			'password' => 'パスワード',
        ];
    }
}
