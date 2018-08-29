<?php

namespace Modules\Ibusiness\Entities;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{

    protected $table = 'ibusiness__businesses';
    protected $fillable = ['name','description','parent_id','budget','options','phone','email','nit','person_firstname','person_lastname'];

    public function users()
    {
        $driver = config('asgard.user.config.driver');
        return $this->belongsToMany("Modules\\User\\Entities\\{$driver}\\User","ibusiness__userbusinesses")
        ->withPivot('businesses_id','user_id')
        ->withTimestamps();

    }
    public function addresses(){
        return $this->morphToMany('Modules\Ibusiness\Entities\Address', 'ibusiness__addressables');
    }

}
