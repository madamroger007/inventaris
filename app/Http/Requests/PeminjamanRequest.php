<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeminjamanRequest extends FormRequest
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
            'nama_peminjam' => 'required|string|max:255',
            'nohp' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'alamat' => 'required|string|max:255',
            'id_barang' => 'required|exists:barang,id',
            'jumlah' => 'required|integer|min:1',
        ];
    }
}
