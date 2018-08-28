<?php

namespace Modules\Ibusiness\Entities;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
  
    protected $table = 'ibusiness__businesses';
    protected $fillable = ['name','description','parent_id','budget','address_1','country','city','postcode'];

    public function users()
    {
        $driver = config('asgard.user.config.driver');
        return $this->belongsToMany("Modules\\User\\Entities\\{$driver}\\User","ibusiness__userbusinesses")
        ->withPivot('businesses_id','user_id')
        ->withTimestamps();

    }

    
}