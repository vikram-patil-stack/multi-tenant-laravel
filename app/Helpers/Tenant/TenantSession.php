<?php

namespace App\Helpers\Tenant;

use Illuminate\Support\Facades\Session;

class TenantSession
{
    /**
     * Get the tenant ID from the session.
     *
     * @return string|null
     */
    public static function getTenantId(): ?string
    {
        return Session::get('tenant_id');
    }

    /**
     * Set the tenant ID in the session.
     *
     * @param string $tenantId
     * @return void
     */
    public static function setTenantId(string $tenantId): void
    {
        if (!self::getTenantId()) {
            Session::put('tenant_id', $tenantId);
        }
    }
}

?>