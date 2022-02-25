<?php

namespace App\Repositories\Master\Service;

use App\Models\Master\Service\Service;
use App\Models\Master\Service\ServiceTranslation;
use App\Models\Master\Service\ViewService;
use App\Repositories\Repository;

class ServiceRepository extends Repository
{

    public function __construct(Service $service, ServiceTranslation $serviceTranslation, ViewService $viewService)
    {
        $this->model = $service;
        $this->modelTranslation = $serviceTranslation;
        $this->modelView = $viewService;
    }
}
