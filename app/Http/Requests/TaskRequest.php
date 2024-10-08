<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class TaskRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status_id' => ['required', 'integer'],
            'description' => ['string', 'nullable', 'max:1000'],
            'assigned_to_id' => ['integer', 'nullable'],
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tasks')->withoutTrashed()->ignore($this->route()?->parameter('task')),
            ]
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => __('Task'),
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => (string) Str::of($this->name)->trim(),
        ]);
    }
}
