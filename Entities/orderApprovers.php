<?php

namespace Modules\Ibusiness\Entities;

use Illuminate\Database\Eloquent\Model;

class OrderApprovers extends Model
{


    protected $table = 'ibusiness__orderapprovers';

    protected $fillable = ['order_id','user_id','status','comment'];


    public function user()
    {
      $driver = config('asgard.user.config.driver');
      return $this->belongsTo("Modules\\User\\Entities\\{$driver}\\User");
    }

    public function order()
    {
        return $this->belongsTo("Modules\Icommerce\Entities\Order");
    }


}
