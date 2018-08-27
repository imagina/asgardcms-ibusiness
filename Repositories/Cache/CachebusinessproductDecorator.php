<?php

namespace Modules\Ibusiness\Repositories\Cache;

use Modules\Ibusiness\Repositories\businessproductRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CachebusinessproductDecorator extends BaseCacheDecorator implements businessproductRepository
{
    public function __construct(businessproductRepository $businessproduct)
    {
        parent::__construct();
        $this->entityName = 'ibusiness.businessproducts';
        $this->repository = $businessproduct;
    }
}
