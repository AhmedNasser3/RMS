<?php

namespace App\Http\Controllers\frontend\home;

use Illuminate\Http\Request;
use App\Models\admin\tax\Tax;
use App\Models\admin\wage\Wage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\admin\charity\Charity;
use App\Models\admin\mission\Mission;
use App\Models\admin\payment\Payment;
use App\Models\admin\statement\Statement;

class HomeController extends Controller
{
    public function index(Request $request)
{
    // نفس الكود الخاص بالفترة الزمنية وتواريخ البداية والنهاية
    $timePeriod = $request->query('period', 'Monthly');
    $startDate = $request->query('start_date', now()->startOfMonth()->toDateString());
    $endDate = $request->query('end_date', now()->endOfMonth()->toDateString());

    // تحديد التاريخ اليومي الحالي
    $today = now();

    // تحديد الـ GROUP BY بناءً على الفترة الزمنية
    $groupBy = '';
    $dateCondition = '';

    switch ($timePeriod) {
        case 'Daily':
            $groupBy = 'DATE(created_at)';
            $dateCondition = $today->toDateString(); // تاريخ اليوم
            break;
        case 'Weekly':
            $groupBy = 'WEEK(created_at)';
            $dateCondition = $today->startOfWeek()->toDateString() . ' to ' . $today->endOfWeek()->toDateString();
            break;
        case 'Monthly':
            $groupBy = 'MONTH(created_at)';
            $dateCondition = $today->format('F Y'); // شهر وسنة
            break;
        case 'Yearly':
            $groupBy = 'YEAR(created_at)';
            $dateCondition = $today->format('Y'); // سنة كاملة
            break;
        default:
            $groupBy = 'MONTH(created_at)';
            $dateCondition = $today->format('F Y');
            break;
    }

    $monthlyWages = DB::table('wages')
    ->select(DB::raw('SUM(bid) as total_wages'), DB::raw($groupBy . ' as period'))
    ->whereBetween('created_at', [$startDate, $endDate]) // إضافة شرط التاريخ
    ->groupBy(DB::raw($groupBy))
    ->get();

// حساب إجمالي الأجور
$totalWages = $monthlyWages->sum('total_wages');

// إذا كنت بحاجة لحساب `over_time_bid` بشكل منفصل:
$over_time_bid = DB::table('wages')
    ->select(DB::raw('SUM(over_time_bid) as total_over_wages'), DB::raw($groupBy . ' as period'))
    ->whereBetween('created_at', [$startDate, $endDate]) // إضافة شرط التاريخ
    ->groupBy(DB::raw($groupBy))
    ->get();

// حساب إجمالي over_time_bid
$totalWagesOverTime = $over_time_bid->sum('total_over_wages');

    // تحويل رقم الأسبوع إلى تنسيق قراءي مثل "Week 1"، "Week 2"
    if ($timePeriod == 'Weekly') {
        $monthlyWages = $monthlyWages->map(function ($item) {
            $item->period = 'Week ' . $item->period; // تحويل رقم الأسبوع إلى صيغة "Week X"
            return $item;
        });
    }


    // استعلام المدفوعات مع الفلاتر على المدى الزمني
    $monthlyPayments = DB::table('payments')
        ->select(DB::raw('SUM(after_tax) as total_payments'), DB::raw($groupBy . ' as period'))
        ->whereBetween('created_at', [$startDate, $endDate]) // إضافة شرط التاريخ
        ->groupBy(DB::raw($groupBy))
        ->get();

    // تحويل رقم الأسبوع إلى تنسيق قراءي مثل "Week 1"، "Week 2"
    if ($timePeriod == 'Weekly') {
        $monthlyPayments = $monthlyPayments->map(function ($item) {
            $item->period = 'Week ' . $item->period; // تحويل رقم الأسبوع إلى صيغة "Week X"
            return $item;
        });
    }

    // حساب إجمالي المدفوعات
    $totalPayments = $monthlyPayments->sum('total_payments');
// استعلام لإجمالي الضريبة
$taxes = DB::table('taxes')
    ->select(DB::raw('SUM(price) as total_taxes'), DB::raw($groupBy . ' as period'))
    ->whereBetween('created_at', [$startDate, $endDate]) // إضافة شرط التاريخ
    ->groupBy(DB::raw($groupBy))
    ->get();

// حساب إجمالي الضريبة
$totalTaxes = $taxes->sum('total_taxes');

    // إرسال البيانات إلى الواجهة
    return view('frontend.home.index', compact(
        'monthlyWages', 'totalWagesOverTime', 'totalWages', 'monthlyPayments', 'totalPayments', 'taxes', 'totalTaxes', 'timePeriod', 'dateCondition', 'startDate', 'endDate'
    ));

}


}