<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;
    public $table = 'customer';

    protected $fillable = ['first_name', 'last_name', 'full_address'];

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }
}
