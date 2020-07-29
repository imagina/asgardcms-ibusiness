<?php

namespace Modules\Ibusiness\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use Translatable;

    protected $table = 'ibusiness__types';
    public $translatedAttributes = [
      'name',
      'description',
    ];
    protected $fillable = [
      'name',
      'description',
    ];
}
