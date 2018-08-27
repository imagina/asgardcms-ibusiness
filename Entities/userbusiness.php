<?php

namespace Modules\Ibusiness\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class userbusiness extends Pivot
{


    protected $table = 'ibusiness__userbusinesses';
    protected $fillable = [
        'businesses_id',
        'user_id'
    ];

    public function business()
    {
        return $this->belongsTo('Modules\Ibusiness\Entities\Business', 'businesses_id');
    }
    public function user()
    {
        return $this->belongsTo('Modules\User\Entities\Sentinel\User', 'user_id');
    }


}
