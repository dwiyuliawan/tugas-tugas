<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    public function transaction()
    {
        return $this->hasOne('App\Models\Transaction', 'id');
    }

    public function book()
    {
        return $this->hasOne('App\Models\Book', 'id');
    }
}