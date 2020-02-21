<?php

namespace App\Http\Requests\Users;

use App\Rules\checkPassword;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class UpdateUserRequest extends FormRequest
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
        // dd($this);
         $validation = [
            'name' => 'required|min:6|max:191',
            'birthday' => 'date_format:Y-m-d|before:today',
            'phone_number' => ['regex :/(09[6-8]|086|03[2-9]|08[3-5]|08[1-2]|088|091|094|07[6-8]|089|090|093|070|079)\d{7}$\b/'],
            'email' => 'required|email|unique:users',
            'gender' => 'required',
            'faculty_id' => 'required',
            'current_password' => '',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|required_with:password',
            'avatar' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'roles' => 'required',
        ];
        if(!empty($this->id)){
            $validation['email'] = 'required|email|unique:users,id,' . $this->id;
            $validation['avatar'] = 'mimes:jpeg,png,jpg,gif,svg|max:2048';
            $validation['roles'] = '';
        }
        // if(!($this->password)){
        //     $validation['password'] = '';
        //     $validation['password_confirmation'] = '';
        //     dd(1);
        // }
        if($this->password){
            if( Auth::user()->password && Auth::user()->id == $this->id ){
                $validation['current_password'] = ['required',new checkPassword];
            }
        }
        else{
            $validation['password'] = '';
            $validation['password_confirmation'] = '';
        }
        return $validation;
    }

    public function messages(){
        return [
            'phone_number.regex' => 'Please enter correct format number phone in VietNam'
        ];
    }

}
