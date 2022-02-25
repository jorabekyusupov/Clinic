<?php
namespace App\Repositories\Master\Person;

use App\Models\Master\Person\Person;
use App\Repositories\Repository;

class PersonRepository extends Repository{

    public function __construct(Person $person)
    {
        $this->model = $person;
    }
}
