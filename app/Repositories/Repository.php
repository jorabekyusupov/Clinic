<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;

abstract class Repository
{
    protected object $model, $modelTranslation, $modelView;

    public function query($relations = null)
    {
        if ($relations) {
            return $this->model->with(...$relations);
        }
        return $this->model->query();
    }

    public function queryView($relations = null)
    {
        if ($relations) {
            return $this->modelView->with(...$relations);
        }
        return $this->modelView->query();
    }

    public function showView($id, $relations = null)
    {
        $model = $this->queryView($relations);
        $model = $model->find($id);
        if ($model) {
            return response()->json($model);
        } else {
            return response()->json('Not found', 404);
        }
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($id, $data)
    {
        $model = $this->query();
        $model = $model->findOrFail($id);
        $model->update($data);
        return $model;
    }

    public function show($id, ...$relations)
    {
        $model = $this->query($relations);
        return $model->find($id);
    }

    public function destroy($id)
    {
        $model = $this->query();
        try {
            $model = $model->find($id);
            $model->delete();
            return response()->noContent();
        } catch (\Throwable $throwable) {
            return response()->json('Not found', 404);
        }
    }

    public function softDelete($id)
    {
        $model = $this->query();
        try {
            $model = $model->find($id);
            $model->deleted_by = Auth::id();
            $model->save();
            $model->delete();
            return response()->noContent();
        } catch (\Throwable $throwable) {
            return response()->json('Not found', 404);
        }
    }

    public function createTranslation($object_id, $translations, $object_name)
    {
        foreach ($translations as $translation) {
            $translation[$object_name] = $object_id;
            $this->modelTranslation->create($translation);
        }
    }

    public function updateTranslation($object_id, $translations, $object_name)
    {
        foreach ($translations as $translation) {
            $model = $this->modelTranslation->where($object_name, $object_id);
            if ($model && isset($translation['id'])) {
                $model->where('id', $translation['id'])
                    ->update($translation);
            } else {
                $translation[$object_name] = $object_id;
                $this->modelTranslation->create($translation);
            }
        }
    }
}
