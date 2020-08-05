<?php

namespace App\Http\Requests\Dashboard\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'first_name' => ['required', 'min:3'],
            'last_name'  => ['required', 'min:3'],
            'email'      => 'required|email|unique:users,email,' . $this->user['id'],
            'image'      => 'image',
            'permission' => 'required'

        ];
    }
}
