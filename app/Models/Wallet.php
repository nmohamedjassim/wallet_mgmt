<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wallet extends Model
{
    use SoftDeletes;
    public $table = 'wallet';    
    protected $fillable = ['balance', 'customer_id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
