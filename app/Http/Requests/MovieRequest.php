<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
//        return false;
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
            'name' => 'required|string|min:1|length',
            'site_url' => 'required|string|min:1|max:3000',
            'picture' => 'required',
            'category_id' => 'required'
        ];
    }


    public function messages()
    {
        return [
            'name.max' => '10文字以内にしてください',
        ];
    }
}
