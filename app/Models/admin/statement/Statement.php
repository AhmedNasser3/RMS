<?php

namespace App\Models\admin\statement;

use App\Models\admin\bank\Bank;
use Illuminate\Database\Eloquent\Model;

class Statement extends Model
{
        // تحديد الحقول المسموح بإدخالها
        protected $fillable = [
            'bank_id',
            'date',
            'detail',
            'debtor',
            'creditor',
            'reason',
        ];

        // العلاقة بين البيان والبنك
        public function bank()
        {
            return $this->belongsTo(Bank::class, 'bank_id');
        }
}
