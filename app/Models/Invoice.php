<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';

    protected $fillable = [
        'media_type',
        'file_path',
        'media_id',
        'caption',
        'phone_number'
    ];
}
