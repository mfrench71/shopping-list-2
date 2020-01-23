<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
                    'title'      => 'required|string|unique:categories,title,NULL,id,user_id,' . auth()->id(),
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'title'      => 'required|string|unique:categories,title,'.$this->category->id.',id,user_id,' . auth()->id(),
                ];
            }
            default:break;
        }
    }
}
