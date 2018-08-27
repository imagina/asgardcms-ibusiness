<?php

namespace Modules\Ibusiness\Repositories\Cache;

use Modules\Ibusiness\Repositories\BusinessRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheBusinessDecorator extends BaseCacheDecorator implements BusinessRepository
{
    public function __construct(BusinessRepository $business)
    {
        parent::__construct();
        $this->entityName = 'ibusiness.businesses';
        $this->repository = $business;
    }
}
