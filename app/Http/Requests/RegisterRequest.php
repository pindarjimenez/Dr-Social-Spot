<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        if(isset($this->email)) {
            $rules['email'] = [
                'required',
                'email',
                'unique:users,email,' . $this->id,
            ];
        }

        if(isset($this->password)) {
            $rules['password'] = [
                'required',
                'min:6',
                'max:50',
                'required_with:confirm_password',
                'same:confirm_password'
            ];
            $rules['confirm_password'] = [
                'required',
                'min:6',
                'max:50'
            ];
        }
        
        if(isset($this->current_password)) {
            $user = Auth::user();

            $rules['current_password'] = [
                'required',
                'min:6',
                'max:50',
                function ($attribute, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        return $fail("Wrong Password!");
                    }
                }
            ];
        }

        return $rules;
    }

    /**
     * custom field name
     * @return array
     */
    public function attributes()
    {
        return [
            'email'    => "email address",
            'password' => "password",
        ];
    }
}
