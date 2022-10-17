<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'name' => "required|min:3|max:255|unique:companies,name,{$this->route('company')},uuid",
            'cnpj' => "required|min:14|max:14|unique:companies,cnpj,{$this->route('company')},uuid",
            'email' => "required|unique:companies,email,{$this->route('company')},uuid",
            'logo' => "nullable|file|mimes:png,jpg",
            'is_active' => 'required|in:Y,N',
            "plan_id" => "required|exists:plans,id",
        ];
    }
}
