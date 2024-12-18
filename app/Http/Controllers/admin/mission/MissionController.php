<?php

namespace App\Http\Controllers\admin\mission;

use Illuminate\Http\Request;
use App\Models\admin\bank\Bank;
use App\Http\Controllers\Controller;
use App\Models\admin\mission\Mission;

class MissionController extends Controller
{
    public function index() {
        $missions = Mission::with('bank')->get();
        return view('admin.mission.index', ['missions' => $missions]);
    }

    public function create() {
        $banks = Bank::all();
        return view('admin.mission.create', compact('banks'));
    }

    public function store(Request $request) {
        Mission::create($request->validate([
            'bank_id' => 'required|string|max:255',
            'price' => 'required|numeric',
            'reason' => 'required|string|max:255',
        ]));
        return redirect()->route('admin.mission.index');
    }

    public function edit($missionId) {
        $mission = Mission::findOrFail($missionId);
        $banks = Bank::all();
        return view('admin.mission.edit', ['mission' => $mission, 'banks' => $banks]);
    }

    public function update(Request $request, $missionId) {
        Mission::findOrFail($missionId)->update($request->validate([
            'bank_id' => 'required|string|max:255',
            'price' => 'required|numeric',
            'reason' => 'required|string|max:255',
        ]));
        return redirect()->route('admin.mission.index');
    }

    public function delete($missionId) {
        Mission::findOrFail($missionId)->delete();
        return redirect()->route('admin.mission.index');
    }
}
