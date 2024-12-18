<?php

namespace App\Http\Controllers\admin\tax;

use Illuminate\Http\Request;
use App\Models\admin\tax\Tax;
use App\Models\admin\bank\Bank;
use App\Http\Controllers\Controller;

class TaxController extends Controller
{
   public function index() {
    $taxes = Tax::with('bank')->get();
    return view('admin.tax.index', ['taxes' => $taxes]);
}

public function create() {
    $banks = Bank::all();
    return view('admin.tax.create', compact('banks'));
}

public function store(Request $request) {
    Tax::create($request->validate([
        'bank_id' => 'required|string|max:255',
        'price' => 'required|numeric',
    ]));
    return redirect()->route('admin.tax.index');
}

public function edit($taxId) {
    $tax = Tax::findOrFail($taxId);
    $banks = Bank::all();
    return view('admin.tax.edit', ['tax' => $tax, 'banks' => $banks]);
}

public function update(Request $request, $taxId) {
    Tax::findOrFail($taxId)->update($request->validate([
        'bank_id' => 'required|string|max:255',
        'price' => 'required|numeric',
    ]));
    return redirect()->route('admin.tax.index');
}

public function delete($taxId) {
    Tax::findOrFail($taxId)->delete();
    return redirect()->route('admin.tax.index');
}
}
