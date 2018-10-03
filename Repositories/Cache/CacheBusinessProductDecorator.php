<?php

namespace Modules\Ibusiness\Repositories\Cache;

use Modules\Ibusiness\Repositories\BusinessProductRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheBusinessProductDecorator extends BaseCacheDecorator implements businessproductRepository
{
    public function __construct(BusinessProductRepository $businessproduct)
    {
        parent::__construct();
        $this->entityName = 'ibusiness.businessproducts';
        $this->repository = $businessproduct;
    }
}
