<?php

namespace AccessManager\Accounts\Http\Requests;


use AccessManager\Base\Http\Requests\BaseFormRequest;

class CustomerAccountRequest extends BaseFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username'  =>  ['required', 'unique:accounts',],
            'password'  =>  ['required',],
            'name'      =>  ['required', ],
        ];
    }
}