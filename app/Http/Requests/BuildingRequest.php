<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BuildingRequest extends FormRequest
{
    protected $errorBag = "bulding";

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
        return [
            "wood" => "required|numeric",
            "clay" => "required|numeric",
            "iron" => "required|numeric",
            "pop"  => "required|numeric",
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            "wood.required" => "Este campo é obrigatório.",
            "wood.number"   => "Este campo precisa ser um número.",

            "clay.required" => "Este campo é obrigatório.",
            "clay.number"   => "Este campo precisa ser um número.",

            "iron.required" => "Este campo é obrigatório.",
            "iron.number"   => "Este campo precisa ser um número.",

            "pop.required"  => "Este campo é obrigatório.",
            "pop.number"    => "Este campo precisa ser um número.",
        ];
    }
}
