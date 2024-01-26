<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePenjualanRequest extends FormRequest
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
            'metode_bayar' => 'required',
            'material' => 'required',
            'mobil' => 'required',
            'harga' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'metode_bayar.required' => 'Kolom metode pembayaran harus di isi.',
            'material.required' => 'Kolom material harus di isi.',
            'mobil.required' => 'Kolom mobil harus di isi.',
            'harga.required' => 'Kolom harga nama harus di isi.',
        ];
    }
}
