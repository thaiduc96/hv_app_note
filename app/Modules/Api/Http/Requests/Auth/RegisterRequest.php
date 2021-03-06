<?php

namespace App\Modules\Api\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|unique:users,phone|numeric',
            'email' => 'nullable|unique:users,email|email',
            'password' => 'required|confirmed|min:6|max:32',
        ];
    }
}
