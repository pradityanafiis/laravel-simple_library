<?php

namespace App\Http\Controllers;

use App\Repositories\BookRepository;
use App\Repositories\MemberRepository;
use App\Repositories\TransactionRepository;
use Carbon\Carbon;

class HomeController extends Controller
{
    private $bookRepository;
    private $memberRepository;
    private $transactionRepository;
    private $labels;
    private $numberOfTransactions;
    private $totalFines;

    public function __construct()
    {
        $this->bookRepository = new BookRepository();
        $this->memberRepository = new MemberRepository();
        $this->transactionRepository = new TransactionRepository();
        $this->labels = collect();
        $this->numberOfTransactions = collect();
        $this->totalFines = collect();
    }

    public function index()
    {
        $this->generateChartData();
        $data = [
            'books' => $this->bookRepository->countAll(),
            'members' => $this->memberRepository->countAll(),
            'transactions' => $this->transactionRepository->countAll(),
            'labels' => $this->labels,
            'numberOfTransactions' => $this->numberOfTransactions,
            'totalFines' => $this->totalFines
        ];
        return view('home', $data);
    }

    private function generateChartData()
    {
        for ($i = 30; $i >= 0; $i--) {
            $date = Carbon::today()->subDay($i);
            $this->labels->push($date->format('d/m'));
            $this->numberOfTransactions->push($this->transactionRepository->countByDate($date));
            $this->totalFines->push($this->transactionRepository->totalFinesByDate($date));
        }
    }
}
