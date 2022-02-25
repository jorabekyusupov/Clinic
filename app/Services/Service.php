<?php

namespace App\Services;

class Service
{
    protected object $repository;

    public function get($relation = null)
    {
        return $this->repository->query($relation);
    }

    public function getView($relation = null)
    {
        return $this->repository->queryView($relation);
    }

    public function paginate($model, $data)
    {
        $page = $data['page'] ?? 1;
        $rows = $data['rows'] ?? 10000;
        $filter = $data['filter'] ?? null;
        $sort = $data['sort'] ?? null;

        return $model->paginate($rows, ['*'], 'page name', $page);

    }

    public function getPaginate($data, $relations = null)
    {
        $page = $data['page'] ?? 1;
        $rows = $data['rows'] ?? 10000;
        $filter = $data['filter'] ?? null;
        $sort = $data['sort'] ?? null;

        return $this->repository->query($relations)
            ->paginate($rows, ['*'], 'page name', $page);
    }

    public function showView($id, $relation = [])
    {
        return $this->repository->showView($id, $relation);
    }

    public function store($data)
    {
        return $this->repository->create($data);
    }

    public function edit($id, $data)
    {
        return $this->repository->update($id, $data);
    }

    public function show($id, $relation = [])
    {
        return $this->repository->show($id, $relation);
    }

    public function delete($id)
    {
        return $this->repository->destroy($id);
    }

    public function softDelete($id)
    {
        return $this->repository->softDelete($id);
    }

    public function storeTranslation($object_id, $translations, $object_name)
    {
        return $this->repository->createTranslation($object_id, $translations, $object_name);
    }

    public function editTranslation($object_id, $translations, $object_name)
    {
        return $this->repository->updateTranslation($object_id, $translations, $object_name);
    }
}
