<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class TaskStatusRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:task_statuses,name,' . $this->id,
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => __('Status'),
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => (string) Str::of($this->name)->lower()->ucfirst(),
        ]);
    }
}
