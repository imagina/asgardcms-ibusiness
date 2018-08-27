<?php

namespace Modules\Ibusiness\Entities;

use Illuminate\Database\Eloquent\Model;

class Order_Approvers extends Model
{
    

    protected $table = 'ibusiness__order_approvers';
    protected $fillable = ['order_id','user_id','status','comment'];


}
