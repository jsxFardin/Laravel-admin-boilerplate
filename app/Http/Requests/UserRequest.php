<?php

namespace App\Http\Requests;

use App\Models\EmployeeDetail;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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

    public function messages()
    {
        return [
            'email.unique' => 'E-mail already exist in your system.',
            'mobile.unique' => 'Mobile no. already exist in your system.'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('user');
        return [
            'name'                  => 'required',
            'email'                 => 'required|email|unique:users,email,' . $id ?: '',
            'password'              => $id ? 'nullable' : 'required|min:6',
            'confirm_password'      => $id ? 'nullable' : 'same:password',
            'role_id'               => 'required|array|min:1',
            'mobile'                => 'required|numeric',
            'address'               => 'nullable|string',
            'remarks'               => 'nullable|string'
        ];
    }
}
