<?php

namespace App\Http\Controllers;

use App\Repositories\TransactionRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \PDF;
use Illuminate\Support\Str;

class ReportController extends Controller
{
    private $transactionRepository;

    public function __construct()
    {
        $this->transactionRepository = new TransactionRepository();
    }

    public function index()
    {
        return view('report.index');
    }

    public function download(Request $request)
    {
        $month = Str::substr($request->month, 5, 2);
        $year = Str::substr($request->month, 0, 4);
        $transactions = $this->transactionRepository->getByMonth($month, $year);
        if ($this->countTransactions($transactions)) {
            $data = [
                'year' => $year,
                'month' => Carbon::createFromFormat('m', $month)->locale('id_ID')->translatedFormat('F'),
                'transactions' => $transactions,
            ];
            $pdf = PDF::loadView('report.template', $data)->setPaper('a4', 'landscape');
            return $pdf->download("E-Library - Transaction Report ($month-$year).pdf");
        } else {
            return redirect()->back()->with('error_message', 'Transaction not found!');
        }
    }

    private function countTransactions($transactions)
    {
        if ($transactions->count() > 0)
            return true;
        else
            return false;
    }
}
