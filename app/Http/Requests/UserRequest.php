<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request
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
        $userId = $this['user_id'];
        $passwordValidation = $userId ? '' : 'required | confirmed';
        $required = $userId ? '' : 'required';

        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'cell_phone' => 'required',
            'email' => 'required | email | unique:users,email,' . "$userId" . ',id',
            'password' => $passwordValidation,
            'password_confirmation' => $required,
            'role' => 'required',
        ];
    }

    /**
     * Get the validation messages that will show on the page.
     *
     * @return array
     */
    public function messages()
    {

        return [
            'first_name.required' => 'First name is require',
            'last_name.required' => 'Last name is require',
            'address.required' => 'Address is require',
            'city.required' => 'City is require',
            'state.required' => 'State is require',
            'zip.required' => 'zip is require',
            'cell_phone.required' => 'Cell Phone is require',
            'email.required' => 'Email is require',
            'email.unique' => 'Email is already exist',
            'password.required' => 'Please enter password',
            'password.confirmed' => 'Password and Confirm password must match',
            'password_confirmation.required' => 'Please enter password',
            'role.required' => 'Please select role',

        ];
    }
}
