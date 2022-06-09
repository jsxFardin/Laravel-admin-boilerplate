<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseRequest extends FormRequest
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
            'expense_type_id'       => 'required',
            'description'           => 'nullable',
            'duration_to'           => 'required',
            'duration_form'         => 'required',
            'travel_to'             => 'required',
            'travel_form'           => 'required',
            // 'amount'                => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
        ];
    }
}
