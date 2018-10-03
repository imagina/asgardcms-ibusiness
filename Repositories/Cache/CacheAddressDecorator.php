<?php

namespace Modules\Ibusiness\Repositories\Cache;

use Modules\Ibusiness\Repositories\AddressRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheAddressDecorator extends BaseCacheDecorator implements AddressRepository
{
    public function __construct(AddressRepository $address)
    {
        parent::__construct();
        $this->entityName = 'ibusiness.addresses';
        $this->repository = $address;
    }
}
