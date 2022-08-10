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
            'LCN' => ['required', 'string', 'max:50'],
            'partsLCN'=>['required','string', 'max:50'],
            'brand'=>['required','string', 'max:50'],
            'model'=>['required','string', 'max:50'],
            'category_id'=>['required'],
            'sub_category_id'=>['required'],
            'productSerialNumber'=>['required'],
            'country_id'=>['required'],
            'dateManufactured'=>['required'],
            'estimatedRetailPrice'=>['required'],
            'notes'=>['sometimes'],
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
        if (filled($this->isComplete)){
            $this->isComplete=1;
        }else{
            $this->isComplete=0;
        }

        $kit = new Kit();
        $kit->fill([
            'work_center_id' => $this->work_center_id,
            'LCN' => $this->LCN,
            'partsLCN' => $this->partsLCN,
            'brand' => $this->brand,
            'model' => $this->model,
            'category_id' => $this->category_id,
            'sub_category_id' => $this->sub_category_id,
            'productSerialNumber' => $this->productSerialNumber,
            'country_id' => $this->country_id,
            'dateManufactured' => $this->dateManufactured,
            'isComplete' => $this->isComplete,
            'estimatedRetailPrice' => $this->estimatedRetailPrice,
            'notes' => $this->notes,
            'User_id' => auth()->id(),
            'kitImageUrl' => 'http://image.url'
        ]);
        $kit->save();
    }
}
