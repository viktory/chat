<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegistrationFormRequest extends Request
{
    protected $errorBag = 'registration';
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
            'username' => 'required|unique:users,username|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|alphaNum|min:3',
        ];
    }
}
