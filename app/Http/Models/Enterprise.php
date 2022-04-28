<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Enterprise extends Model
{
    protected $fillable = [
        'name', 'ruc', 'description', 'file_path', 'logo', 'address',
        'email', 'web', 'telephone', 'whatsapp', 'created_at', 'updated_at'
    ];
}
