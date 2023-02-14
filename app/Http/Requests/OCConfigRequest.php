<?php

namespace App\Http\Requests;

use App\Models\OCConfig;
use App\Models\Tv;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class OCConfigRequest extends FormRequest
{
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
        $rules = [
            "brand" => "required",
            "model" => "required",
            "partNumber" => "required",
            "mitSku" => "required",
            "instructions" => "sometimes"
        ];

        if($this->hasFile('assemblyGuide'))
        {
            $rules["assemblyGuide"] ="required|file|mimetypes:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel";

        }

        return $rules;

    }
}
