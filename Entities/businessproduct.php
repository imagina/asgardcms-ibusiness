<?php

namespace Modules\Ibusiness\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class businessproduct extends Pivot
{
  
    protected $table = 'ibusiness__businessproducts';
    protected $fillable = [
        'product_id',
        'business_id',
        'price'
    ];

    
}
