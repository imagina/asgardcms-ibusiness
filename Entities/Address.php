<?php

namespace Modules\Ibusiness\Entities;


use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
   
    protected $table = 'ibusiness__addresses';
    protected $fillable = [
    'firstname',
    'lastname',
    'company',
    'address_1',
    'address_2',
    'city',
    'postcode',
    'country',
    'zone',
    'type'
  ];


    public function bussiness()
    {
        return $this->morphedByMany('Modules\Ibusiness\Entities\Business', 'addressable');
    }


}
