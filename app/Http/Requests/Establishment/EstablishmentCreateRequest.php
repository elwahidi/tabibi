<?php

namespace App\Http\Requests\Establishment;

use App\Category;
use App\Rules\PhoneRules;
use Illuminate\Foundation\Http\FormRequest;

class EstablishmentCreateRequest extends FormRequest
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
            // step 1
            'city'                          => ['required', 'int', 'exists:cities,id'],
            // step 2
            'name'                          => ['required', 'string', 'min:3', 'max:191'],
            'address_establishment'         => ['required', 'string', 'min:5', 'max:191'],
            'build'                         => ['required', 'int', 'min:1'],
            'floor'                         => ['required', 'int', 'min:1'],
            'apt_nbr'                       => ['required', 'int', 'min:1'],
            'zip'                           => ['required', 'int', 'min:1000'],
            'description_establishment'     => ['required', 'string'],
            'phones_establishment.*'        => ['required',new PhoneRules()],
            // step 3
            'face'                          => ['nullable', 'mimes:jpg,png,jpeg,gif'],
            'first_name'                    => ['required', 'string', 'min:3', 'max:191'],
            'last_name'                     => ['required', 'string', 'min:3', 'max:191'],
            'description'                   => ['nullable', 'string', 'min:3'],
            'birth'                         => ['nullable', 'date'],
            'email'                         => ['required', 'string', 'email', 'unique:users,email'],
            'password'                      => ['required', 'string', 'min:8', 'max:16', 'confirmed'],
            'category'                      => ['required', 'int', 'exists:categories,id'],
            'specialty'                     => [$this->doctor(), 'int', 'exists:specialties,id'],
            'sexe'                          => ['required', 'int', 'exists:sexes,id'],
            'phones.*'                      => ['nullable', 'string', new PhoneRules()],
            'seance'                        => [$this->doctor(), 'date_format:H:i'],
            // step 4
            'imgs.*'                        => ['nullable', 'mimes:jpg,png,jpeg,gif']
        ];
    }

    private function doctor()
    {
        if($this->category === Category::where('category','doctor')->first()->id){
            return 'required';
        }
        return 'nullable';
    }
}
