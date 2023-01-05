<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

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
        return [
            "nickname"       => "required|string",
            "email"          => "required|" . Rule::unique( "users", "email" )->ignore( $this->user ),
            "password"       => "required",
            "sex"            => "nullable",
            "is_banned"      => "nullable",
            "is_admin"       => "nullable",
            "ip"             => "nullable",
            "alliance_id"    => "nullable",
            "cached_points"  => "nullable",
            "cached_rank"    => "nullable",
            "cached_village" => "nullable",
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
            "nickname.required" => "Este campo é obrigatório.",
            "nickname.string"   => "Este campo é obrigatório.",
            "email.required"    => "Este campo é obrigatório.",
            "email.unique"      => "Este e-mail já está em uso.",
            "password.required" => "Este campo é obrigatório.",
        ];
    }
}
