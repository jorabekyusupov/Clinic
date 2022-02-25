<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\ServiceClass\ViewServiceClass;
use App\Services\Master\ServiceClassService;
use Illuminate\Http\Request;
use App\Services\MainService;
use Illuminate\Support\Facades\DB;

class ServiceClassController extends Controller
{
    protected ServiceClassService $serviceClassService;

    public function __construct(ServiceClassService $serviceClassService)
    {
        $this->serviceClassService = $serviceClassService;
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $language = $request->language;

        return ViewServiceClass::whereNull('deleted_at')
            ->where('name', 'ilike', '%'.$search.'%')
            ->where('language_code', $language)
            ->orderBy('id')
            ->paginate(10000);
    }

    public function show($id)
    {
        return $this->serviceClassService->edit($id);
    }

    public function update($id, Request $request)
    {
        $form = $request->input('form');
        DB::beginTransaction();
        try {
            $result = $this->serviceClassService->update($id, $form);
            DB::commit();
            return response($result, 201);
        } catch (\Throwable $throwable) {
            DB::rollBack();
            info($throwable->getMessage());
            return response('Not found', 404);
        }
    }

    public function destroy($id)
    {
        try {
            $this->serviceClassService->delete($id);
            return response("Successfully deleted", 200);
        } catch (\Throwable $throwable) {
            DB::rollBack();
            return response('Not found', 404);
        }
    }

    public function list(Request $request, MainService $mainService)
    {
        $language = $request['language'];
        $originalEvent = $request->input('originalEvent');
        $page = isset($originalEvent['page']) ? $originalEvent['page'] + 1 : 1;
        $rows = $originalEvent['rows'];
        $models = ViewServiceClass::select()->whereNull('deleted_at')->where('language_code', $language);
        $mainService->filterModels($models, $originalEvent);

        return $models->paginate($rows == '-1' ? 1000000 : $rows, ['*'], 'page name', $page);
    }
}
