<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LoginFormRequest extends Request
{
    protected $errorBag = 'login';
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
            'username' => 'required_without:email',
            'email' => 'required_without:username',
            'password' => 'required',
        ];
    }

    public function getErrorBag()
    {
        return $this->errorBag;
    }
}
