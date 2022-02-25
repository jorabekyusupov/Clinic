<?php

namespace App\Repositories\Master\Contact;

use App\Models\Master\Contact\Contact;
use App\Repositories\Repository;

class ContactRepository extends Repository
{
    public function __construct(Contact $contact)
    {
        $this->model = $contact;
    }
}
