<?php

namespace App\Http\Requests;

use App\Models\Student;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
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
            //
            'name' => ['required', 'string'],
            'identification_number' => ['required', 'string', Rule::unique(Student::class)->ignore($this->student()->id)],
            'phone_number' => ['required', 'integer'],
            'study_program' => ['required', 'string'],
            'student_class' => ['required', 'string'],
        ];
    }
}
