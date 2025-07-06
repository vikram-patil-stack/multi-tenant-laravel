<?php

namespace App\Models;

use App\Traits\Uuid7;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tenant extends Model
{
    use SoftDeletes, Uuid7;

    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'domain',
        'is_active'
    ];

    public function isDomainExists(string $domain): bool
    {
        return $this->where('domain', $domain)->exists();
    }

    public function getTenantId(string $domain): bool | string
    {
        $tenant = $this->select(['id'])->where('domain', $domain)->firstOrFail();
        return $tenant ? $tenant->id : false;
    }

    public function create(string $domain) : bool
    {
        $this->domain = $domain;
        $this->is_active = true;

        return $this->save();
    }
}
