<?php

namespace App\Http\Requests;

use App\Employee;
use App\Project;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskRequest extends FormRequest
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
            'name' => ['required'],
            'assigned_to' => ['nullable', Rule::in(Employee::all()->pluck('id'))],
            'deadline' => ['nullable', 'date_format:d-m-Y','after:today'],
            'project_id' => ['nullable', Rule::in(Project::all()->pluck('id'))],
            'status_id' => ['nullable']
        ];
    }
}
