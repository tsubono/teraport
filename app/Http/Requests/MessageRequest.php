<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MessageRequest extends FormRequest
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
            'content' => 'required|max:255',
            'message_id' => 'required',
        ];
    }

    public function attributes()
    {
        return [
			'content' => '内容',
			'message_id' => 'メッセージID',
        ];
    }
}
