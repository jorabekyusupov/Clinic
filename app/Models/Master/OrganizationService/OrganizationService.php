<?php

namespace App\Models\Master\OrganizationService;

use App\Models\Master\Organization\Organization;
use App\Models\Master\Service\ViewService;
use App\Traits\NewHasFactory;
use Database\Factories\OrganizationServiceFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationService extends Model
{
    use NewHasFactory;

    protected static string $factoryModel = OrganizationServiceFactory::class;

    protected $fillable = ['organization_id', 'service_id', 'price', 'updated_by', 'created_by', 'deleted_by'];
    public function service()
    {
        return $this->hasOne(ViewService::class, 'id', 'service_id');
    }

    public function organization()
    {
        return $this->hasOne(Organization::class, 'id', 'organization_id');
    }
}
