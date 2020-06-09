<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Earning;
use App\Repositories\EarningRepository;
use Auth;

class EarningController extends Controller {
    private $earningRepository;

    public function __construct(EarningRepository $earningRepository)
    {
        $this->earningRepository = $earningRepository;
    }

    public function create() {
        return view('earnings.create');
    }

    public function store(Request $request) {
        $request->validate($this->earningRepository->getValidationRules());

        $this->earningRepository->create(
            session('space')->id,
            $request->input('date'),
            $request->input('description'),
            (int) ($request->input('amount') * 100)
        );

        return redirect()->route('dashboard');
    }

    public function edit(Earning $earning) {
        $this->authorize('edit', $earning);

        return view('earnings.edit', compact('earning'));
    }

    public function update(Request $request, Earning $earning) {
        $this->authorize('update', $earning);

        $request->validate($this->earningRepository->getValidationRules());

        $this->earningRepository->update($earning->id, [
            $request->input('date'),
            $request->input('description'),
            (int) ($request->input('amount') * 100)
        ]);

        return redirect()->route('transactions.index');
    }

    public function destroy(Earning $earning) {
        $this->authorize('delete', $earning);

        $restorableEarning = $earning->id;

        $earning->delete();

        return redirect()
            ->route('transactions.index');
    }

    public function restore($id) {
        $earning = Earning::withTrashed()->find($id);

        if (!$earning) {
            // 404
        }

        $this->authorize('restore', $earning);

        $earning->restore();

        return redirect()->route('transactions.index');
    }
}
