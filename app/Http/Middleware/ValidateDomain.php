<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Helpers\Tenant\TenantSession;
use Symfony\Component\HttpFoundation\Response;

class ValidateDomain
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $domain = $request->getHost();
        
        $tenantModel = new Tenant();

        try {

            $tenantId = $tenantModel->getTenantId($domain);
            TenantSession::setTenantId($tenantId);
            
            return $next($request);
        } catch (\Throwable $th) {
            //throw $th;
            return abort(403, 'Domain not registered');
        }
        
    }
}
