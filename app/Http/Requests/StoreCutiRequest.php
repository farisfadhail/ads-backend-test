<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreCutiRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nomor_induk' => 'required',
            'tanggal_cuti' => 'required|date',
            'lama_cuti' => 'required|integer',
            'keterangan' => 'required|string|max:255'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 'failed',
            'message' => 'Validation errors',
            'data' => $validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'nomor_induk.required' => 'Nomor induk is required!',
            'tanggal_cuti.required' => 'Tanggal cuti is required!',
            'lama_cuti.required' => 'Lama cuti is required!',
            'keterangan.required' => 'Keterangan is required!',
        ];
    }
}
