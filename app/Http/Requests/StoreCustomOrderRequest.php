<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomOrderRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'min:10'],
            'product_type' => ['required', 'string', 'in:invitations,wall-art,paper-crafts,albums,cards,decorations,journals,gift-wrap,frames,other'],
            'quantity' => ['required', 'string'],
            'budget' => ['required', 'string', 'in:under-5k,5k-10k,10k-25k,25k-50k,50k-plus,flexible'],
            'event_date' => ['nullable', 'date', 'after:today'],
            'description' => ['required', 'string', 'min:10'],
            'additional_notes' => ['nullable', 'string'],
        ];
    }
}
