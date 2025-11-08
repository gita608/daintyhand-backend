<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'shipping_name' => ['required', 'string', 'min:2', 'max:255'],
            'shipping_address' => ['required', 'string', 'min:5'],
            'shipping_city' => ['required', 'string', 'min:2', 'max:100'],
            'shipping_state' => ['required', 'string', 'min:2', 'max:100'],
            'shipping_pincode' => ['required', 'string', 'min:6', 'max:10'],
            'shipping_phone' => ['required', 'string', 'min:10'],
            'payment_method' => ['required', 'string', 'in:cod,online,card'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
