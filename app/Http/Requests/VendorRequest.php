<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
            "name" => "required|string|max:150",
            "phone" => "required|string|max:100",
            "category_id" => "required|exists:main_categories,id",
            "logo" => "required|image|mimes:png,jpg,jpeg",
            "address" => "string|sometimes|nullable|max:450",
            "email" => "required|email|max:150|unique:vendors,email",
            "password" => "required|confirmed|min:6|max:100",
            "active" => "in:0,1",
            "latitude" => "required|string|max:240",
            "longitude" => "required|string|max:240",

        ];

        if(in_array($this->getMethod(),["PUT","PATCH"])){
            $rules['email']    = "email|" . Rule::unique("vendors","email")->ignore($this->vendor);
            $rules['password'] = "sometimes|nullable|confirmed|min:6|max:100";
            $rules["logo"]     = "sometimes|nullable|image|mimes:png,jpg,jpeg";

        }


        return $rules;
    }

    public function messages()
    {
        return [
            "category_id.exists" => __("admin.category not found"),
        ];
    }
}
