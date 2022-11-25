<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KhoaHocRequest extends FormRequest
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
        switch($method){
                case 'store':
                    return [
                        //
                        'tenKhoaHoc' => 'unique:khoa_hocs,tenKhoa'
                    ];
                break;
                case 'update':
                    return [
                        //
                        'tenKhoaHoc' => 'unique:khoa_hocs,tenKhoa,'.$this->id.',id'
                    ];
                break;
        }
    }

    public function messages()
        {
            return [
                'tenKhoaHoc.unique' => __('messages.exist',['attribute' => 'Khoá']),
            ];
        }
}
