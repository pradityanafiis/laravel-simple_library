<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Repositories\BookRepository;
use App\Repositories\MemberRepository;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransactionController extends Controller
{
    private $bookRepository;
    private $memberRepository;
    private $transactionRepository;
    private $today;

    public function __construct()
    {
        $this->bookRepository = new BookRepository();
        $this->memberRepository = new MemberRepository();
        $this->transactionRepository = new TransactionRepository();
        $this->today = Carbon::now();
    }

    public function index()
    {
        $data = $this->transactionRepository->getActive();
        return view('transaction.index', ['data' => $data]);
    }

    public function create()
    {
        return view('transaction.create', [
            'books' => $this->bookRepository->getAvailable(),
            'members' => $this->memberRepository->getAll()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'book' => ['required', 'numeric', 'exists:books,id'],
            'member' => ['required', 'numeric', 'exists:members,id'],
            'period' => ['required', 'numeric', 'min:1', 'max:7']
        ]);

        $request->request->add(['return_date' => $this->setReturnDate($request->period)]);
        $data = $request->only(['book', 'member', 'return_date']);

        if ($this->transactionRepository->create($data)) {
            return redirect()->back()->with('success_message', 'Transaction created!');
        } else {
            return redirect()->back()->with('error_message', 'Unable to create transaction!');
        }
    }

    public function show(Transaction $transaction)
    {
        return view('transaction.show', ['transaction' => $transaction]);
    }

    public function edit(Transaction $transaction)
    {
        //
    }

    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    public function destroy(Transaction $transaction)
    {
        //
    }

    public function returnBook(Transaction $transaction)
    {
        if ($this->isOverdue($transaction->return_date)) {
            $data = [
                'fine' => $this->calculateFine($this->countOverdueDays($transaction->return_date)),
                'status' => 'overdue'
            ];
        } else {
            $data = [
                'fine' => 0,
                'status' => 'finished'
            ];
        }

        if ($this->transactionRepository->update($data, $transaction->id)) {
            return redirect()->back()->with('success_message', 'Book returned!');
        } else {
            return redirect()->back()->with('error_message', 'Unable to return book!');
        }
    }

    public function cancelTransaction(Transaction $transaction)
    {
        $data = [
            'status' => 'canceled'
        ];

        if ($this->transactionRepository->update($data, $transaction->id)) {
            return redirect()->back()->with('success_message', 'Transaction canceled!');
        } else {
            return redirect()->back()->with('error_message', 'Unable to cancel transaction!');
        }
    }

    private function setReturnDate(int $period)
    {
        return $this->today->addDay($period)->toDateString();
    }

    private function isOverdue($returnDate)
    {
        if ($this->today > $returnDate)
            return true;
        else
            return false;
    }

    private function countOverdueDays($returnDate)
    {
        $returnDate = Carbon::createFromFormat('Y-m-d', $returnDate);
        return $this->today->diffInDays($returnDate);
    }

    private function calculateFine($overdueDays)
    {
        return $overdueDays * 3000;
    }
}
