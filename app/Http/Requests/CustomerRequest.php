<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    private $table            = 'customer';
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
        $id = $this->id;
        $login=$this->login;

        $condName = 'required';

        $condEmail  = "bail|required|email|unique:$this->table,email";
        $condPhone  = "bail|required|between:3,100|unique:$this->table,phone";
        $condPass = "bail|required|between:1,100|confirmed";
        $condAccount="";


        if(!empty($login)){ // login
            $condAccount = 'required';
            $condPass  .= "required";
            $condName =$condEmail=$condPhone='';
        }
        return [
            'name' => $condName,
            'phone'=>$condPhone,
            'email'=>$condEmail,
            'password'=>$condPass,
            'account'=>$condAccount
//            'status'      => 'bail|in:active,inactive',
        ];
    }

    public function messages()
    {
        return [
            // 'name.required' => 'Name không được rỗng',
            // 'name.min'      => 'Name :input chiều dài phải có ít nhất :min ký tứ',
        ];
    }
    public function attributes()
    {
        return [
            // 'description' => 'Field Description: ',
        ];
    }
}
