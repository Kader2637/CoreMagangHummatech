<?php

namespace App\Http\Requests;

use App\Rules\StatusApprovalRule;
use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'description' => 'nullable',
            'proof' => 'nullable',
            'start' => 'nullable',
            'end' => 'nullable',
            'status' => 'nullable'
        ];
    }
}
