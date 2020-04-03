<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Employee;

class EmployeeFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        // // an authorized user who is an Admin can create a company
        // return Auth::guard('company')->user()->can('create-employee', Employee::class);

        //  // an authorized user who is an Admin can delete a company
        //  $employee = Employee::find($this->route('employee'));
        //  return $employee && Auth::guard('company')->user()->can('delete-employee', $employee);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'role' => 'required|numeric',
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ];
    }
}
