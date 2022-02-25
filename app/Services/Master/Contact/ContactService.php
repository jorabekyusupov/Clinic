<?php

namespace App\Services\Master\Contact;

use App\Services\MainService;
use App\Repositories\Master\Contact\ContactRepository;
use App\Services\Service;

class ContactService extends Service
{
    private MainService $mainService;

    public function __construct(ContactRepository $contactRepository, MainService $mainService)
    {
        $this->repository = $contactRepository;
        $this->mainService = $mainService;
    }

    public function indexContact($data)
    {
        $object_id = $data['object_id'];
        $object_type = $data['object_type'];
        return $this->repository->query()->where('object_type', $object_type)->where('object_id', $object_id)->get();
    }

    public function updateContact($data)
    {
        $contacts = $data['contacts'];
        $delete_contacts = array();
        $contacts_object_types = array();
        $contacts_object_ids = array();

        foreach ($contacts as $key => $contact) {
            $delete_contacts[$key] = $contact['id'];
            $contacts_object_types[$key] = $contact['object_type'];
            $contacts_object_ids[$key] = $contact['object_id'];
        }
        $this->repository->query()->whereIn('object_type', $contacts_object_types)
            ->whereIn('object_id', $contacts_object_ids)
            ->whereNotIn('id', $delete_contacts)
            ->delete();
        try {
            foreach ($contacts as $contact) {
                $model = $this->repository->show($contact['id']);
                if ($model || (isset($contact['value']) && $contact['value'])) {
                    if (!$model) {
                        unset($contact['id']);
                        $contact['created_by'] = $this->mainService->auth::id();
                        $this->store($contact);
                    } else {
                        $contact['updated_by'] = $this->mainService->auth::id();
                        $this->edit($model->id, $contact);
                    }
                }
            }
            return response()->json("Successfully");
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not implemented', 501);
        }
    }
}
