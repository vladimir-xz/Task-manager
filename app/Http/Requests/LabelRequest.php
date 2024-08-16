<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('labels')->ignore($this->route()?->parameter('label'))
            ],
            'description' => ['string', 'nullable'],
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
            'name' => (string) Str::of($this->name)->trim()->lower(),
        ]);
    }
}
