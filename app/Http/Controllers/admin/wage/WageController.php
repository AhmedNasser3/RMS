<?php

namespace App\Http\Controllers\admin\wage;

use Illuminate\Http\Request;
use App\Models\admin\bank\Bank;
use App\Models\admin\wage\Wage;
use App\Http\Controllers\Controller;

class WageController extends Controller
{
    public function index() {
        $wages = Wage::with('bank')->get();
        return view('admin.wage.index', ['wages' => $wages]);
    }

    public function create() {
        $banks = Bank::all();
        return view('admin.wage.create',compact('banks'));
    }

    public function store(Request $request) {
        Wage::create($request->validate([
            'bank_id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'date' => 'required',
            'bid' => 'required',
            'over_time_bid' => 'required',
        ]));
        return redirect()->route('admin.wage.index');
    }

    public function edit($wageId) {
        $wage = Wage::findOrFail($wageId);
        return view('admin.wage.edit', ['wage' => $wage]);
    }

    public function update(Request $request, $wageId) {
        Wage::findOrFail($wageId)->update($request->validate([
            'bank_id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'date' => 'required',
            'bid' => 'required',
            'over_time_bid' => 'required',
        ]));
        return redirect()->route('admin.wage.index');
    }

    public function delete($wageId) {
        Wage::findOrFail($wageId)->delete();
        return redirect()->route('admin.wage.index');
    }
}
