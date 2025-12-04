<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Settings extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        'opening_time',
        'closing_time',
        'is_store_open',
    ];
  
    
}

