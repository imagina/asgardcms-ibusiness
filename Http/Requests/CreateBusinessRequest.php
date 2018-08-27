<?php

namespace Modules\Ibusiness\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateBusinessRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
          'name'=>'required|max:40|min:5',
          'description'=>'required|max:60|min:2',
          'address_1'=>'required|max:40',
          'country'=>'required',
          'city'=>'required',
          'postcode'=>'required|max:10'
        ];
    }

    public function translationRules()
    {
        return [];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [];
    }

    public function translationMessages()
    {
        return [];
    }
}
