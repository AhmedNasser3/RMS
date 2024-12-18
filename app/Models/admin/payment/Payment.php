<?php

namespace App\Models\admin\payment;

use App\Models\admin\bank\Bank;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'bank_id',
        'name',
        'before_tax',
        'after_tax',
        'tax_number',
    ];
// في ملف Wage.php
public function bank()
{
    return $this->belongsTo(Bank::class, 'bank_id');
}

}
