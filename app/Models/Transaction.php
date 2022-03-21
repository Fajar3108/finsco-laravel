<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['receiver_id', 'sender_id', 'confirmed_by_id', 'product_id', 'type_id', 'status_id', 'amount', 'description', 'code'];

    public function confirmed_by()
    {
        return $this->belongsTo(User::class, 'confirmed_by_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function product()
    {
        return $this->belongsTo(User::class, 'product_id');
    }

    public function type()
    {
        return $this->belongsTo(TransactionType::class, 'type_id');
    }

    public function status()
    {
        return $this->belongsTo(TransactionStatus::class, 'status_id');
    }
}
