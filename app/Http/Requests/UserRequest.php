<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        $method = $this->route()->getActionMethod();

        if($method == 'teacher_store'){
            return [
                'username' => 'unique:users,username'
            ];
        }

        if($method == 'teacher_update'){
            return [
                'username' => 'unique:users,username,'.$this->id.',id'
            ];
        }
    }

    public function messages()
    {
        return [
            'username.unique' => __('messages.exist',['attribute' => 'Tên đăng nhập']),
        ];
    }
}
