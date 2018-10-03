<?php

namespace Modules\Ibusiness\Repositories\Cache;

use Modules\Ibusiness\Repositories\OrderApproversRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheOrderApproversDecorator extends BaseCacheDecorator implements OrderApproversRepository
{
    public function __construct(OrderApproversRepository $orderapprovers)
    {
        parent::__construct();
        $this->entityName = 'ibusiness.orderapprovers';
        $this->repository = $orderapprovers;
    }
}
