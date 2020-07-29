<?php

namespace Modules\Ibusiness\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Modules\Ihelpers\Transformers\BaseApiTransformer;

class TypeTransformer extends BaseApiTransformer
{
    public function toArray($request)
    {
        $filter = json_decode($request->filter);
        $data = [
            'id' => $this->id,
            'name' => $this->name ?? '',
            'description' => $this->description ?? '',
        ];

        /*RELATIONSHIPS*/
        // Tax Class
        // $this->ifRequestInclude('user') ?
            // $data['user'] = ($this->added_by_id ? new UserTransformer($this->addedBy) : false) : false;

        // TRANSLATIONS
        $filter = json_decode($request->filter);
        // Return data with available translations
        if (isset($filter->allTranslations) && $filter->allTranslations) {
            // Get langs avaliables
            $languages = \LaravelLocalization::getSupportedLocales();

            foreach ($languages as $lang => $value) {
                if ($this->hasTranslation($lang)) {
                    $data[$lang]['name'] = $this->hasTranslation($lang) ?
                        $this->translate("$lang")['name'] : '';
                    $data[$lang]['description'] = $this->hasTranslation($lang) ?
                        $this->translate("$lang")['description'] : '';
                }
            }
        }

        return $data;
    }

}
