<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ServiceRequest extends FormRequest
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
            'category_id' => 'required',
            'title' => 'required|max:255',
            'content' => 'required',
            'price' => 'required',
            'real_name' => 'required',
        ];
    }

    public function attributes()
    {
        return [
			'category_id' => 'カテゴリ',
			'title' => 'タイトル',
			'content' => '内容',
			'price' => 'お布施',
			'real_name' => '実名',
        ];
    }
}
