<?php

namespace App\Http\Requests;

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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'name' => [
                'required'
            ],
            
            'email' => [
                'required',
                'email',
                Rule::unique('users')
            ],

            'password' => [
                'nullable'
            ],

            'role' => [
                'required',
                'exists:roles,name'
            ],

            'profile_image' => [
                'nullable',
                'mimes:jpeg,jpg,png'
            ],

            'identity_proof' => [
                'nullable',
                'mimes:pdf'
            ]
        ];

        if($this->getMethod() == 'PUT'){

            $rules['id'] = [
                'required',
                'exists:users,id'
            ];

            $rules['email'] = [
                'required',
                'email',
                Rule::unique('users')->ignore($this->id, 'id')
            ];
        }

        return $rules;
    }

    public function getUserPayLoad(){

        return collect($this->validated())
            ->toArray();
    }
}
