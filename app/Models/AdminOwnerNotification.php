<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminOwnerNotification extends Model
{
    use HasFactory;

    protected $table = 'admin_owner_notifications';

    protected $fillable = [
        'owner_id',
        'sender_type',
        'content',
        'is_read',
    ];

    public function owner(){
        return $this->belongsTo(Owner::class);
    }

    public function admin(){
        return $this->belongsTo(Admin::class);
    }
}
