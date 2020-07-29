<?php

namespace Modules\Ibusiness\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateBusinessRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
          'user_id' => 'required',
          'coords' => 'required',
        ];
    }

    public function translationRules()
    {
        return [
          // 'name' => 'required|min:2',
          // 'description' => 'required|min:2'
        ];
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
