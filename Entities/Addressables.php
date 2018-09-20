<?php

namespace Modules\Ibusiness\Entities;

use Illuminate\Database\Eloquent\Model;

class Addressables extends Model
{
    protected $table="ibusiness__addressables";
    protected $fillable = ['address_id','ibusiness__addressables_id','ibusiness__addressables_type'];
}
