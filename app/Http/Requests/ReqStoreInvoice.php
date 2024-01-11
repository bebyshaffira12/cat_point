<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use App\Traits\ResponseBuilder;

class ReqStoreInvoice extends FormRequest
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
            "status_pembayaran"          => "bail|required",
            "booking_id"                 => "bail|required|numeric|exists:booking,id",
            "order_id"                   => "bail|required|numeric|exists:order,id",
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
