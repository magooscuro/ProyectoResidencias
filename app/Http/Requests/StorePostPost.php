<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * 
     * @return bool
     */
     public static function myRules (){ 
         return [
        'title' => 'required|min:5|max:255',
        'url_clean' => 'max:255|unique:posts',
        'content' => 'required|min:5',
        'category_id' => 'required',
        'posted' => 'required'
    ];
}

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
       return $this->myRules();
    }
}
