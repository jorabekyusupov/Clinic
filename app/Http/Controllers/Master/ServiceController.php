<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\ListRequest;
use App\Services\Master\Service\ServiceService;
use App\Http\Requests\Master\Service\ServiceIndexRequest;
use App\Http\Requests\Master\Service\ServiceStoreUpdateRequest;

class ServiceController extends Controller
{
    private ServiceService $serviceService;


    public function __construct(ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    public function index(ServiceIndexRequest $serviceIndexRequest)
    {
        return $this->serviceService->indexService($serviceIndexRequest->validated());
    }

    public function show($id)
    {
        return $this->serviceService->showService($id);
    }

    public function store(ServiceStoreUpdateRequest $serviceStoreUpdateRequest)
    {
        return $this->serviceService->storeService($serviceStoreUpdateRequest->validated());
    }

    public function update($id, ServiceStoreUpdateRequest $serviceStoreUpdateRequest)
    {
        return $this->serviceService->updateService($id, $serviceStoreUpdateRequest->validated());
    }

    public function destroy($id)
    {
        return $this->serviceService->softDelete($id);
    }

    public function list(ListRequest $listRequest)
    {
        return $this->serviceService->listService($listRequest->validated());
    }
}
