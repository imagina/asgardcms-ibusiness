<?php

namespace Modules\Ibusiness\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateBusinessRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
          'name'=>'required|max:40|min:4',
          'description'=>'required|max:60|min:2',
          'address_1'=>'required|max:40|min:3',
          'address_2'=>'max:40',
          'country'=>'required',
          'city'=>'required|max:50',
          'postcode'=>'required|max:10',
          'nit'=>'required|min:11|max:11',
          'person_first_name'=>'required|min:4|max:40',
          'person_last_name'=>'required|min:4|max:40',
          'firstname'=>'required|min:4|max:40',
          'lastname'=>'required|min:4|max:40',
          'budget'=>'required|numeric',
          'email'=>'required|string|email'
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
        return [
          'name.required' => trans('ibusiness::businesses.messages.name_required'),
          'name.min' => trans('ibusiness::businesses.messages.name_min 4'),
          'name.max' => trans('ibusiness::businesses.messages.name_max 40'),
          'description.required' => trans('ibusiness::businesses.messages.description_required'),
          'description.min' => trans('ibusiness::businesses.messages.description_min 2'),
          'description.max' => trans('ibusiness::businesses.messages.description_max 60'),
          'address_1.required' => trans('ibusiness::businesses.messages.address_1_required'),
          'address_1.min' => trans('ibusiness::businesses.messages.address_1_min 3'),
          'address_1.max' => trans('ibusiness::businesses.messages.address_1_max 40'),
          'person_first_name.min'=>'El nombre del representante legal debe tener minimo 4 digitos',
          'address_2.max' => trans('ibusiness::businesses.messages.address_2_max 40'),
          'country.required' => trans('ibusiness::businesses.messages.country_required'),
          'city.required' => trans('ibusiness::businesses.messages.city_required'),
          'postcode.required' => trans('ibusiness::businesses.messages.postcode_required'),
          'postcode.max' => trans('ibusiness::businesses.messages.postcode_max 10'),
          'nit.required' => trans('ibusiness::businesses.messages.nit_required'),
          'nit.min' => trans('ibusiness::businesses.messages.nit_min 11'),
          'nit.max' => trans('ibusiness::businesses.messages.nit_max 11'),
          'person_first_name.required' => trans('ibusiness::businesses.messages.person_first_name_required'),
          'person_first_name.min' => trans('ibusiness::businesses.messages.person_first_name_min 4'),
          'person_first_name.max' => trans('ibusiness::businesses.messages.person_first_name_max 40'),
          'person_last_name.required' => trans('ibusiness::businesses.messages.person_last_name_required'),
          'person_last_name.min' => trans('ibusiness::businesses.messages.person_last_name_min 4'),
          'person_last_name.max' => trans('ibusiness::businesses.messages.person_last_name_max 40'),
          'firstname.required' => trans('ibusiness::businesses.messages.firstname_required'),
          'firstname.min' => trans('ibusiness::businesses.messages.firstname_min 4'),
          'firstname.max' => trans('ibusiness::businesses.messages.firstname_max 40'),
          'lastname.required' => trans('ibusiness::businesses.messages.lastname_required'),
          'lastname.min' => trans('ibusiness::businesses.messages.lastname_min 4'),
          'lastname.max' => trans('ibusiness::businesses.messages.lastname_max 40'),
          'budget.required' => trans('ibusiness::businesses.messages.budget_required'),
          'email.required' => trans('ibusiness::businesses.messages.email_required'),

        ];
    }

    public function translationMessages()
    {
        return [];
    }
}
