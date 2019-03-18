<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DaoModuleCreateRequest extends FormRequest
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
            'height' => 'required',
            'width' => 'required',
        ];
    }

    /**
     * Return the fields and values to create a new post from
     */
    public function postFillData()
    {
        return [
            'name' => $this->name,
            'type' => $this->type,
            'height' => $this->height,
            'width' => $this->height,
            'createTime' => time(),
            'updateTime' => time(),
            'isBan' => $this->isBan,
            'remark' => $this->remark,
        ];
    }
}
