<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\ServiceSubsection\ViewServiceSubsection;
use App\Services\Master\ServiceSubsectionService;
use Illuminate\Http\Request;
use App\Services\MainService;
use Illuminate\Support\Facades\DB;

class ServiceSubsectionController extends Controller
{
    protected $serviceSubsectionService;

    public function __construct(ServiceSubsectionService $serviceSubsectionService)
    {
        $this->serviceSubsectionService = $serviceSubsectionService;
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $language = $request->language;

        return ViewServiceSubsection::whereNull('deleted_at')
            ->where('name', 'ilike', '%'.$search.'%')
            ->where('language_code', $language)
            ->orderBy('id')
            ->paginate(20);
    }

    public function show($id)
    {
        return $this->serviceSubsectionService->edit($id);
    }

    public function update($id, Request $request)
    {
        $form = $request->input('form');
        DB::beginTransaction();
        try {
            $result = $this->serviceSubsectionService->update($id, $form);
            DB::commit();
            return response($result, 201);
        } catch (\Throwable $throwable) {
            DB::rollBack();
            return response($throwable->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->serviceSubsectionService->delete($id);
            return response("Successfully deleted", 200);
        } catch (\Throwable $throwable) {
            DB::rollBack();
            return response($throwable->getMessage(), 500);
        }
    }

    public function list(Request $request, MainService $mainService)
    {
        $language = $request['language'];
        $originalEvent = $request->input('originalEvent');
        $page = isset($originalEvent['page']) ? $originalEvent['page'] + 1 : 1;
        $rows = $originalEvent['rows'];
        $models = ViewServiceSubsection::select()->whereNull('deleted_at')->where('language_code', $language);
        $mainService->filterModels($models, $originalEvent);

        return $models->paginate($rows == '-1' ? 1000000 : $rows, ['*'], 'page name', $page);
    }
}
