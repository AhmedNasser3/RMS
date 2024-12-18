<?php

namespace App\Http\Controllers\admin\statement;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\admin\bank\Bank;
use App\Http\Controllers\Controller;
use App\Models\admin\statement\Statement;

class StatementController extends Controller
{
    public function index() {
        $statements = Statement::with('bank')->get();
        return view('admin.statement.index', ['statements' => $statements]);
    }

    public function create() {
        $banks = Bank::all();
        return view('admin.statement.create', compact('banks'));
    }

    public function store(Request $request) {
        Statement::create($request->validate([
            'bank_id' => 'required|string|max:255',
            'date' => 'required|date',
            'detail' => 'required|string|max:255',
            'debtor' => 'required|string|max:255',
            'creditor' => 'required|string|max:255',
            'reason' => 'required|string|max:255',
        ]));
        return redirect()->route('admin.statement.index');
    }

    public function edit($statementId) {
        $statement = Statement::findOrFail($statementId);
        $banks = Bank::all();
        $statement->date = Carbon::parse($statement->date);
        return view('admin.statement.edit', ['statement' => $statement, 'banks' => $banks]);
    }

    public function update(Request $request, $statementId) {
        Statement::findOrFail($statementId)->update($request->validate([
            'bank_id' => 'required|string|max:255',
            'date' => 'required|date',
            'detail' => 'required|string|max:255',
            'debtor' => 'required|string|max:255',
            'creditor' => 'required|string|max:255',
            'reason' => 'required|string|max:255',
        ]));
        return redirect()->route('admin.statement.index');
    }

    public function delete($statementId) {
        Statement::findOrFail($statementId)->delete();
        return redirect()->route('admin.statement.index');
    }
}
