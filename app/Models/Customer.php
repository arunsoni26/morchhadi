<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;
  
  	protected $casts = [
    	'dob' => 'date',
	];
    
    protected $fillable = [
        'name','user_id','gender','mobile','email','city','dob',
        'status','password', 'state', 'pincode', 'country', 'shipping_address', 'billing_address', 'whatsapp_number',
        'house_no', 'locality', 'landmark'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function group()
    {
        return $this->belongsTo(CustomerGroup::class);
    }

    public function verifiedYears()
    {
        return $this->hasMany(CustomerGstYearVerified::class, 'customer_id');
    }
}
