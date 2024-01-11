<?php

namespace App\Http\Requests;

use App\Traits\ResponseBuilder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ReqUpdateBooking extends FormRequest
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
            "nama_pemilik"          => "nullable",
            "no_telfon"             => "nullable|numeric",
            "alamat"                => "nullable",
            "nama_hewan"            => "nullable",
            "ciri_khusus_hewan"     => "nullable",
            "umur_kucing"           => "nullable|numeric",
            "jenis_kucing"          => "nullable",
            "check_in"              => "nullable|date_format:Y-m-d H:i:s",
            "check_out"             => "nullable|date_format:Y-m-d H:i:s",
            "berat"                 => "nullable",
            "jenis_kelamin_kucing"  => "nullable",
            "treatment_id"          => "nullable|numeric|exists:treatment,id",
            "service_id"            => "nullable|numeric|exists:service,id",
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
