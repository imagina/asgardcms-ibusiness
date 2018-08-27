<?php

namespace Modules\Ibusiness\Repositories\Cache;

use Modules\Ibusiness\Repositories\orderApproversRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheorderApproversDecorator extends BaseCacheDecorator implements orderApproversRepository
{
    public function __construct(orderApproversRepository $orderapprovers)
    {
        parent::__construct();
        $this->entityName = 'ibusiness.orderapprovers';
        $this->repository = $orderapprovers;
    }
}
