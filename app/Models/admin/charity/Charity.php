<?php

namespace App\Models\admin\charity;

use App\Models\admin\bank\Bank;
use Illuminate\Database\Eloquent\Model;

class Charity extends Model
{
    protected $fillable = [
        'bank_id',
        'price',

    ];

// في ملف Wage.php
public function bank()
{
    return $this->belongsTo(Bank::class, 'bank_id');
}
}
