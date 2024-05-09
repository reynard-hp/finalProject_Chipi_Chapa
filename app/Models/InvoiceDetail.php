<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'InvoiceId',
        'ItemId',
        'quantity'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'InvoiceId', 'id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'ItemId', 'id');
    }
}
