<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable= [
        'order_id',
        'frist_name',
        'last_name',
        'phone',
        'street_address',
        'city',
        'state',
        'zip_code',
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function getFullNameAttribute(){
        return "{$this->frist_name} {$this->last_name}";
    }
}
