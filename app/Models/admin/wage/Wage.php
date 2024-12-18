<?php

namespace App\Models\admin\wage;

use App\Models\admin\bank\Bank;
use Illuminate\Database\Eloquent\Model;

class Wage extends Model
{
    protected $fillable = [
        'bank_id',
        'name',
        'date',
        'bid',
        'over_time_bid',
    ];

// في ملف Wage.php
public function bank()
{
    return $this->belongsTo(Bank::class, 'bank_id');
}



}
