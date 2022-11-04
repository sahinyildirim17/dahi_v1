<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        //todo bu requestten permit etmenin ilk denemesi.
        if(auth()->user()->can('posts_create')){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'post_type'=>'required',
            'title'=>'required|mix:5',
            'content'=>'required'
        ];
    }

    public function attributes()
    {
        return [
            'post_type'=>'İçerik türü',
            'title'=>'Başlık',
            'content'=>'İçerik',
        ];
    }
}
