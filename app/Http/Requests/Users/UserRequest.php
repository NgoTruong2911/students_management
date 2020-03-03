<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * [
     *
     *
     *
     * ]
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:6|max:191',
            'birthday' => 'required',
            'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3|max:191',
            'gender' => 'required',
            'role' => 'required',
            'faculty_id' => 'required',
            'avatar' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

}
