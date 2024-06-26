<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
            'description' => 'required',
            'sub_course_id' => 'required',
            'title' => 'required',
            'level' => 'required'
        ];
    }



    public function messages()
    {
        return [
            'title.required' => 'Judul Tidak boleh kosong',
            'description.required' => 'Deskripsi Tidak boleh kosong',
            'sub_course_id.required' => 'Sub course Tidak boleh kosong',
            'level.required' => 'Level tidak boleh kosong',
        ];
    }
}
