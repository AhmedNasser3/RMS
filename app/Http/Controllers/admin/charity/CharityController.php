<?php

namespace App\Http\Controllers\admin\charity;

use Illuminate\Http\Request;
use App\Models\admin\bank\Bank;
use App\Http\Controllers\Controller;
use App\Models\admin\charity\Charity;

class CharityController extends Controller
{
    public function index() {
        $charities = Charity::with('bank')->get();
        return view('admin.charity.index', ['charities' => $charities]);
    }

    public function create() {
        $banks = Bank::all();
        return view('admin.charity.create', compact('banks'));
    }

    public function store(Request $request) {
        Charity::create($request->validate([
            'bank_id' => 'required|string|max:255',
            'price' => 'required|numeric',
            'reason' => 'required|string|max:255',
        ]));
        return redirect()->route('admin.charity.index');
    }

    public function edit($charityId) {
        $charity = Charity::findOrFail($charityId);
        $banks = Bank::all();
        return view('admin.charity.edit', ['charity' => $charity, 'banks' => $banks]);
    }

    public function update(Request $request, $charityId) {
        Charity::findOrFail($charityId)->update($request->validate([
            'bank_id' => 'required|string|max:255',
            'price' => 'required|numeric',
            'reason' => 'required|string|max:255',
        ]));
        return redirect()->route('admin.charity.index');
    }

    public function delete($charityId) {
        Charity::findOrFail($charityId)->delete();
        return redirect()->route('admin.charity.index');
    }
}
