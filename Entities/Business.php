<?php

namespace Modules\Ibusiness\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Media\Support\Traits\MediaRelation;
use Modules\Core\Traits\NamespacedEntity;
class Business extends Model
{
  use Translatable,MediaRelation,NamespacedEntity;

  protected $table = 'ibusiness__businesses';
  public $translatedAttributes = ['name','description'];
  protected $fillable = [
    'nit',
    'coords',
    'options',
    'phone',
    'email',
    'user_id',
    'city_id',
    'web_url',
    'facebook_url',
    'instagram_url',
    'twitter_url',
    'youtube_url',
    'type_business_id',
  ];

  protected $casts = [
    'options' => 'array',
    'coords' => 'array',
  ];

  public function getOptionsAttribute($value)
  {
    return json_decode($value);
  }

  public function getCoordsAttribute($value)
  {
    return json_decode($value);
  }


  public function getMainImageAttribute()
  {
    $thumbnail = $this->files()->where('zone', 'mainimage')->first();
    if (!$thumbnail) {
      if (isset($this->options->mainimage)) {
        $image = [
          'mimeType' => 'image/jpeg',
          'path' => url($this->options->mainimage)
        ];
      } else {
        $image = [
          'mimeType' => 'image/jpeg',
          'path' => url('modules/iblog/img/post/default.jpg')
        ];
      }
    } else {
      $image = [
        'mimeType' => $thumbnail->mimetype,
        'path' => $thumbnail->path_string
      ];
    }
    return json_decode(json_encode($image));
  }

  public function getSecondaryImageAttribute()
  {
    $thumbnail = $this->files()->where('zone', 'secondaryimage')->first();
    if (!$thumbnail) {
      $image = [
        'mimeType' => 'image/jpeg',
        'path' => url('modules/iblog/img/post/default.jpg')
      ];
    } else {
      $image = [
        'mimeType' => $thumbnail->mimetype,
        'path' => $thumbnail->path_string
      ];
    }
    return json_decode(json_encode($image));
  }

}
