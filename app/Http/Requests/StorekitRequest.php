<?php

namespace App\Http\Requests;

use App\Models\Kit;
use Illuminate\Foundation\Http\FormRequest;

class StorekitRequest extends FormRequest
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
            'work_center_id'=>['required'],
            'LCN'=>['required'],
            'partsLCN'=>['required'],
            'brand'=>['required'],
            'model'=>['required'],
            'category_id'=>['required'],
            'sub_category_id'=>['required'],
            'productSerialNumber'=>['required'],
            'countryOrigin'=>['required'],
            'dateManufactured'=>['required'],
            'isComplete'=>['required'],
            'estimatedRetailPrice'=>['required'],
            'notes'=>['required'],
            'user_id'=>['required'],
            'kitImageUrl'=>['required'],
        ];

//        if ($this->method() === 'PUT') {
//
//            $rules['SKU'] = ['sometimes'];
//            $rules['LanguageID'] = ['sometimes'];
//            $rules['Title80'] = ['required', 'string', 'max:80'];
//            $rules['Title200'] = ['required', 'string', 'max:200'];
//            $rules['Bullet1'] = ['required', 'string', 'max:200'];
//            $rules['Bullet2'] = ['required', 'string', 'max:200'];
//            $rules['Bullet3'] = ['required', 'string', 'max:200'];
//            $rules['Bullet4'] = ['required', 'string', 'max:200'];
//            $rules['Bullet5'] = ['required', 'string', 'max:200'];
//            $rules['ShortDescription'] = ['required', 'string', 'max:500'];
//            $rules['Description'] = ['required', 'string', 'max:2000'];
//            $rules['SearchTerms'] = ['required', 'string', 'max:200'];
//        }

        return $rules;
    }


    public function createKit()
    {
        $kit = Kit::create($this->all());

        return $kit;
    }
}
