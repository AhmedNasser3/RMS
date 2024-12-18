<?php

namespace App\Models\admin\mission;

use App\Models\admin\bank\Bank;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    protected $fillable = [
        'bank_id',
        'price',
        'reason',

    ];

// في ملف Wage.php
public function bank()
{
    return $this->belongsTo(Bank::class, 'bank_id');
}
}
