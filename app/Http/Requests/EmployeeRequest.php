<?php

namespace App\Http\Requests;

use App\Department;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeRequest extends FormRequest
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
            'login' => ['required', 'unique:employees'],
            'password' => ['required'],
            'dep_id' => ['nullable', Rule::in(Department::all()->pluck('id'))]
        ];
    }
}
