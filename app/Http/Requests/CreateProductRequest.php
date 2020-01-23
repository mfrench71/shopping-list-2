<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'title'      => 'required|string|unique:products,title,NULL,id,user_id,' . auth()->id(),
                    'category_id'  => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'title'      => 'required|string|unique:products,title,'.$this->product->id.',id,user_id,' . auth()->id(),
                    'category_id'  => 'required',
                ];
            }
            default:break;
        }
    }
}
