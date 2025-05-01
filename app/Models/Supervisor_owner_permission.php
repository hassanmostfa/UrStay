<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Supervisor_owner_permission extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function supervisor(): HasOne
    {
        return $this->hasOne(Supervisor::class, 'id', 'supervisor_id');
    }

    public function owner(): HasOne
    {
        return $this->hasOne(Owner::class, 'id', 'owner_id');
    }
}
