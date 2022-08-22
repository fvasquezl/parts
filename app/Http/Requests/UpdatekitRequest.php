<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatekitRequest extends FormRequest
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
            'work_center_id'=>['required'],
            'LCN' => ['required',Rule::unique('sqlsrv.prt.PartsKitData')->ignore($this->kit)],
            'partsLCN'=>['required','string', 'max:50'],
            'brand'=>['required','string', 'max:50'],
            'model'=>['required','string', 'max:50'],
            'category_id'=>['required'],
            'sub_category_id'=>['required'],
            'productSerialNumber'=>['required'],
            'country_id'=>['required'],
            'dateManufactured'=>['required'],
            'notes'=>['sometimes'],
//            'kitImage' => ['required','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
        ];
    }
}
