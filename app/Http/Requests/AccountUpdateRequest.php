<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountUpdateRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        if($this->password == null) {
            $this->request->remove('password');
        }
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
            'email' => 'email|required|unique:users,email,' . auth()->user()->id,
            'password' =>'nullable|required_with:password_confirmation|confirmed',
            'role' => 'required',
            'slug' => 'required|unique:users,slug,' .auth()->user()->id,

            ];


    }
}

