<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTariffRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Ubah ke true
    }

    public function rules(): array
    {
        // Sesuai Spesifikasi Database di PDF (tbTarifListrik)
        return [
            'kd_tarif' => 'required|string|max:4|unique:electricity_tariffs,kd_tarif',
            'beban' => 'required|integer|min:0',
            'tarif_per_kwh' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'kd_tarif.required' => 'Kode Tarif wajib diisi.',
            'kd_tarif.unique' => 'Kode Tarif sudah terdaftar.',
            'beban.integer' => 'Beban harus berupa angka bulat.',
        ];
    }
}
