<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
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


        $rules = [
            "name" => "required|string|max:120|unique:languages,name",
            "abbr" => "required|max:5",
            "active" => "required|in:0,1",
            "direction" => "required|in:rtl,ltr",
        ];


          if($this->getMethod() == "PUT" || $this->getMethod() == "PATCH"){
             $rules['name'] = "required|string|max:120|" . Rule::unique("languages","name")->ignore($this->language) ;
          }


         return $rules;


    }


}
