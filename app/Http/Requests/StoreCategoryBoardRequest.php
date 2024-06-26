<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryBoardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'hummatask_team_id' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'title harus diisi',
            'hummatask_team_id.required' => 'id team harus dipilih',
        ];
    }
}
