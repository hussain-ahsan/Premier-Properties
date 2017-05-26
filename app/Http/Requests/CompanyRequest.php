<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CompanyRequest extends Request
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
        $company_id = $this['company_id'];
        return [
            'name' => 'required',
            'ein' => 'required | unique:companies,ein,' . "$company_id" . ',id',
            'phone' => 'required',
            'email' => 'required | email | unique:companies,email,' . "$company_id" . ',id',
            'contact' => 'required',
            'address' => 'required',
            'city' => 'required',
            'states' => 'required',
            'zip' => 'required',
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
            'name.required' => 'name is require',
            'ein.required' => 'ein is require',
            'phone.required' => 'phone is require',
            'email.required' => 'email address is require',
            'contact.required' => 'contact is require',
            'address.required' => 'address is require',
            'city.required' => 'city is require',
            'states.required' => 'State is require',
            'zip.required' => 'zip is require',
        ];
    }
}
