<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use App\Traits\ResponseBuilder;

class ReqStoreService extends FormRequest
{
    use ResponseBuilder;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "paket_fluffy"          => "bail|required",
            "harga"                 => "bail|required|numeric",
            "deskripsi"             => "bail|required",
            "gambar"                => "bail|required",
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            $this->createResponse(
                false,
                'Validation error',
                $validator->errors(),
                400
            )
        );
    }
}
