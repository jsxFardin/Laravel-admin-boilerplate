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
        $details = EmployeeDetail::where('user_id', '=', $id)->first();
        return [
            'name'                  => 'required',
            'email'                 => 'required|email|unique:users,email,'.$id?: '',
            'password'              => $id ? 'nullable' : 'required|min:6',
            'confirm_password'      => $id ? 'nullable' : 'same:password',
            'role_id'               => 'required|array|min:1',
            // 'branch_id'         => 'required',
            'department_id'         => 'required',
            // 'designation_id'    => 'required',
            'joining_date'          => 'required',
            'blood_group'           => 'required',
            'mobile'                => [
                Rule::unique('employee_details')->ignore($details ? $details->id : '', 'id')
                // Rule::unique('employee_details')->where(function ($query) use($id, $details) {
                //     return $query->where('user_id',  $id)
                //         ->where('id', $details ? $details->id : '');
                // })
            ],
            'accommodation_cost'    => 'required|numeric',
            'daily_allowance_cost'  => 'required|numeric',
        ];
    }
}
