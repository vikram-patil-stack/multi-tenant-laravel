<?php

namespace App\Models;

use App\Traits\Uuid7;
use App\Traits\MultiTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes, Uuid7, MultiTenant;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $keyType = 'string';
    
    protected $fillable = [
        'name',
        'status',
        'tenant_id'
    ];

    public function getAll()
    {
        return $this->latest()->get();
    }

    public function insert(array $input) : bool
    {
        $master = $this->create($input);
        return !is_null($master);
    }

}
