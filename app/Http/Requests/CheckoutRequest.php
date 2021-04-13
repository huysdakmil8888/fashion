<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
        $account = $this->create_account;
        $condEmail="required";
        $condPhone="required";
        $condPass="";

        if(isset($account)){
            $condEmail  = "bail|required|unique:$this->table,email";
            $condPhone  = "bail|required|unique:$this->table,phone";
            $condPass   =   "bail|required|confirmed";
        }


       
        return [
            'name'          => 'required',
            'email'         => $condEmail,
            'phone'         => $condPhone,
            'address'       => 'required',
            'shipping_id'   => 'required',
            'password'      => $condPass,
            'payment_id'    => 'required',
            'accept'        => 'required'

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
