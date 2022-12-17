<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
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

        if($method == 'subject_store'){
            return [
                'maMonHoc' => 'unique:mon_hocs,maMon'
            ];
        }

        if($method == 'subject_update'){
            return [
                'maMonHoc' => 'unique:mon_hocs,maMon,'.$this->id.',id'
            ];
        }
    }

    public function messages()
    {
        return [
            'maMonHoc.unique' => __('messages.exist',['attribute' => 'Mã môn học']),
        ];
    }
}
