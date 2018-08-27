<?php

namespace Modules\Ibusiness\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateBusinessRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
          'name'=>'required|max:40|min:5',
          'description'=>'required|max:60|min:2'
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
