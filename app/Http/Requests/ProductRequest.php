<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        if(request()->isMethod('POST')){
            $data =  [
                'category_id' => 'required',
                'supplier_id' => 'required',
                'name' => 'required|unique:products',
                'description' => 'required',
                'unit' => 'required',
                'image' => 'required|mimes:png,jpg,jpeg|max:2048',
            ];
        }elseif(request()->isMethod('PUT')){
            $data = [
                'category_id' => 'required',
                'supplier_id' => 'required',
                'name' => 'required', 'unique:products,name'.$this->id,
                'image' => 'mimes:png,jpg,jpeg|max:2048',
                'description' => 'required',
                'unit' => 'required'
            ];
        }
        return $data;
    }
}
