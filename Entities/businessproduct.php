<?php

namespace Modules\Ibusiness\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class BusinessProduct extends Pivot
{

    protected $table = 'ibusiness__businessproducts';
    protected $fillable = [
        'product_id',
        'business_id',
        'price'
    ];

    public function product()
    {
        return $this->belongsTo('Modules\Icommerce\Entities\Product', 'product_id');
    }

}
