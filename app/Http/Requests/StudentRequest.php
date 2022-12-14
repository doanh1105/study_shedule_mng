<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        $method = $this->route()->getActionMethod();

        if($method == 'student_store'){
            return [
                'username' => 'unique:users,maNguoiDung'
            ];
        }

        if($method == 'student_update'){
            return [
                'username' => 'unique:users,maNguoiDung,'.$this->id.',id'
            ];
        }
    }

    public function messages()
    {
        return [
            'username.unique' => __('messages.exist',['attribute' => 'Mã sinh viên']),
        ];
    }
}
