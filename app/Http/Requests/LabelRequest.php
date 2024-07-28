<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class LabelRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:labels,name,' . $this->id,
            'description' => 'string|nullable',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => __('Label'),
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => (string) Str::of($this->name)->lower(),
        ]);
    }
}
