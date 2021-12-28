<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title'=>'required|max:30',
            'body'=>'required|max:255',
            'image'=>'required|max:1024|mimes:jpg,jpeg,png,gif'
        ];
    }

    //日本語は以下のようにFormRequest.messagesメソッドをオーバーライドする
    public function messages(){
        return [
            'title.required'=>'タイトルは必須です',
            'title.max'=>'タイトルは30文字までです',
            'body.required'=>'本文は必須です',
            'body.max'=>'本文は255文字までです',
            'image.required'=>'画像は必須です',
            'image.max'=>'1Mbyteまでです',
            'image.mimes'=>'jpg,jpeg,png,gifだけ'
        ];
    }

}
