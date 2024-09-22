<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['customer_name','customer_phone', 'price', 'date', 'status', 'invoice_number'];

    
    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
}
