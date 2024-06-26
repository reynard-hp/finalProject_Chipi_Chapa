<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function invoiceDetails()
    {
        return $this->hasMany(InvoiceDetail::class, 'InvoiceId', 'id');
    }
}
