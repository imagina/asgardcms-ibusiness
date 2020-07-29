<?php

namespace Modules\Ibusiness\Entities;

use Illuminate\Database\Eloquent\Model;

class TypeTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [
      'name',
      'description',
    ];
    protected $table = 'ibusiness__type_translations';
}
