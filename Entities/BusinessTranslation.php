<?php

namespace Modules\Ibusiness\Entities;

use Illuminate\Database\Eloquent\Model;

class BusinessTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [
      'name',
      'description',
    ];
    protected $table = 'ibusiness__business_translations';
}
