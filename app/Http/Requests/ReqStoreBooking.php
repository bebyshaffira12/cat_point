<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use App\Traits\ResponseBuilder;

class ReqStoreBooking extends FormRequest
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
            "nama_pemilik"          => "bail|required",
            "no_telfon"             => "bail|required|numeric",
            "alamat"                => "bail|required",
            "nama_hewan"            => "bail|required",
            "ciri_khusus_hewan"     => "bail|required",
            "umur_kucing"           => "bail|required|numeric",
            "jenis_kucing"          => "bail|required",
            "check_in"              => "bail|required|date_format:Y-m-d H:i:s",
            "check_out"             => "bail|required|date_format:Y-m-d H:i:s",
            "berat"                 => "bail|required",
            "jenis_kelamin_kucing"  => "bail|required",
            "treatment_id"          => "bail|required|numeric|exists:treatment,id",
            "service_id"            => "bail|required|numeric|exists:service,id",
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
