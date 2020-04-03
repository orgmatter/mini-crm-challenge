<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Str;
use App\Company;

class CompanyFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // an authorized user who is an Admin can create a company
        return $this->user()->can('create-company', Company::class);

         // an authorized user who is an Admin can delete a company
         $company = Company::find($this->route('company'));
         return $company && $this->user()->can('delete-company', $company);
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
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'url' => 'required'
        ];
    }
}
