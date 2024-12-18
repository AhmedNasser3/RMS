<?php

namespace App\Http\Controllers\admin\bank;

use App\Http\Controllers\Controller;
use App\Models\admin\bank\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index() {
        $banks = Bank::select('id', 'name', 'created_at as date')->get();
        return view('admin.bank.index', ['banks' => $banks]);
    }

    public function create(){
        return view('admin.bank.create');
    }
    public function store(Request $request) {
        Bank::create($request->validate(['name' => 'required']));
        return redirect()->route('admin.bank.index');
    }
    public function edit(Request $request, Bank $bankId){
        return view('admin.bank.edit',['banks' => Bank::findOrFail($bankId)]);
    }
    public function update(Request $request, $bankId) {
        Bank::findOrFail($bankId)->update($request->validate(['name' => 'required']));
        return redirect()->route('admin.bank.index');
    }
    public function delete($bankId){
        Bank::findOrFail($bankId)->delete();
        return redirect()->route('admin.bank.index');
    }
}
