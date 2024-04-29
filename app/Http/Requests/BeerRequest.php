<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BeerRequest extends FormRequest
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
        'name' => ['required', 'max:255', Rule::unique('beers', 'name')->ignore($this->route('beer')?->id)],
        'point' => ['nullable', 'numeric', 'min:0', 'max:10'], // Made 'point' field nullable
        'type' => ['nullable'], // Removed 'required' rule
        'alc_content' => ['required', 'numeric', 'min:0.5'],
    ];
    }

}
