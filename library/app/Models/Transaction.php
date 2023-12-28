<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public function member()
    {
        return $this->belongsTo('App\Models\Member', 'id');
    }

    public function transaction_detail()
    {
        return $this->hasOne('App\Models\TransactionDetail', 'transaction_id');
    }
}
