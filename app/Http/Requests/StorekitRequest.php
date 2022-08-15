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
//        if (filled($this->isCompleted)){
//            $this->isCompleted=1;
//        }else{
//            $this->isCompleted=0;
//        }

        $kit = new Kit();
        $kit->fill([
            'WorkCenterID' => $this->work_center_id,
            'LCN' => $this->LCN,
            'KitLCN' => $this->partsLCN,
            'Brand' => $this->brand,
            'Model' => $this->model,
            'PartCategoryID' => $this->category_id,
            'ProductSerialNumber' => $this->productSerialNumber,
            'CountryID' => $this->country_id,
            'DateManufactured' => $this->dateManufactured,
//            'IsCompleted' => $this->isCompleted,
//            'EstimatedRetailPrice' => $this->estimatedRetailPrice,
            'UserID' => auth()->id(),
            'PartSubCategoryID' => $this->sub_category_id,
            'Comments' => $this->notes,
            'kitImage' => 'http://image.url'
        ]);
        $kit->save();
    }
}
