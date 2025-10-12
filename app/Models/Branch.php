<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'owner_name',
        'shop_name',
        'contact_person',
        'email',
        'phone_number',
        'whatsapp_number',
        'gst_number',
        'branch_type',
        'address',
        'city',
        'state',
        'pincode',
        'country',
        'latitude',
        'longitude',
        'link',
        'opening_time',
        'closing_time',
        'status',
        'remarks',
        'total_sales',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    // Optional: define relationships to User
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deleter()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
