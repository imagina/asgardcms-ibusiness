<?php

namespace Modules\Ibusiness\Repositories\Cache;

use Modules\Ibusiness\Repositories\userbusinessRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheUserBusinessDecorator extends BaseCacheDecorator implements userbusinessRepository
{
    public function __construct(userbusinessRepository $userbusiness)
    {
        parent::__construct();
        $this->entityName = 'ibusiness.userbusinesses';
        $this->repository = $userbusiness;
    }
}
