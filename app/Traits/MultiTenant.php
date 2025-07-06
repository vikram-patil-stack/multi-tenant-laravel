<?php

namespace App\Traits;

use App\Models\Scopes\TenantScope;
use App\Helpers\Tenant\TenantSession;

trait MultiTenant
{
    /**
     * Boot the trait.
     */
    public static function bootMultiTenant(): void
    {
        static::creating(function ($model) {
            if (empty($model->tenant_id)) {

                $tenantId = TenantSession::getTenantId();
                if ($tenantId) {
                    $model->tenant_id = $tenantId;
                }
            }
        });
    }

    static function boot()
    {
        parent::boot();

        static::addGlobalScope(new TenantScope());
    }
    // static::addGlobalScope(new TenantScope());
}
?>