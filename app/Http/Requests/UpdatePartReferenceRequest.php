<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePartReferenceRequest extends FormRequest
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
        return [
            'PartName' =>  ['required', 'string', 'max:50'],
//            'PartValue' =>  ['required'],
            'PartWeight' =>  ['required','numeric','between:0,999.99'],
            'PartRef1' =>  ['required', 'string', 'max:50'],
            'PartRef2' => ['sometimes'],
            'PartRef3' =>  ['sometimes'],
        ];
    }
}
