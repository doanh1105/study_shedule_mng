<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        $method = $this->route()->getActionMethod();

        if($method == 'room_store'){
            return [
                'maPhongHoc' => 'unique:phong_hocs,maPhongHoc'
            ];
        }

        if($method == 'room_update'){
            return [
                'maPhongHoc' => 'unique:phong_hocs,maPhongHoc,'.$this->id.',id'
            ];
        }
    }

    public function messages()
    {
        return [
            'maPhongHoc.unique' => __('messages.exist',['attribute' => 'Mã phòng học']),
        ];
    }
}
