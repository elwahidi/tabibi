<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ParameterRequest extends FormRequest
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
        $r = [
            'face'              => ['nullable', 'mimes:jpg,png,gif,jpeg'],

            'first_name'        => ['required', 'string', 'min:3', 'max:191'],

            'last_name'         => ['required', 'string', 'min:3', 'max:191'],

            'birth'             => ['required', 'date'],

            'description'       => ['nullable', 'string', 'min:10'],

            'email'             => ['required', 'string', 'email', 'unique:users,email,' . auth()->user()->id],

            'sexe'              => ['required', 'int', 'exists:sexes,id'],

            'city'              => ['required', 'int', 'exists:cities,id']
        ];

        if(auth()->user()->category->category === 'doctor'){

            $r['specialty'] = ['required', 'int', 'exists:specialties,id'];

        }

        return $r;

    }


}
