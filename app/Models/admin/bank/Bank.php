<?php

namespace App\Models\admin\bank;

use App\Models\admin\charity\Charity;
use App\Models\admin\mission\Mission;
use App\Models\admin\payment\Payment;
use App\Models\admin\tax\Tax;
use App\Models\admin\wage\Wage;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = [
        'name',
    ];

// في ملف Bank.php
public function wages()
{
    return $this->hasMany(Wage::class, 'bank_id');
}
public function tax()
{
    return $this->hasMany(Tax::class, 'bank_id');
}
public function charity()
{
    return $this->hasMany(Charity::class, 'bank_id');
}
public function mission()
{
    return $this->hasMany(Mission::class, 'bank_id');
}

    public function payment(){
        return $this->hasMany(Payment::class);
    }
}
