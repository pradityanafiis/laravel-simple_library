<?php


namespace App\Repositories;


use App\Models\Transaction;
use Carbon\Carbon;

class TransactionRepository implements BaseRepository
{
    private $transaction;

    public function __construct()
    {
        $this->transaction = new Transaction();
    }

    public function getAll()
    {
        return $this->transaction->all();
    }

    public function findById($id)
    {
        // TODO: Implement findById() method.
    }

    public function create(array $data)
    {
        return $this->transaction->create([
            'book_id' => $data['book'],
            'member_id' => $data['member'],
            'return_date' => $data['return_date'],
            'status' => 'active'
        ]);
    }

    public function update(array $data, $id)
    {
        return $this->transaction->findOrFail($id)->update($data);
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function getActive()
    {
        return $this->transaction->where('status', 'active')->get();
    }

    public function countAll()
    {
        return $this->transaction->all()->count();
    }

    public function countByDate($date)
    {
        return $this->transaction
            ->whereDate('created_at', $date)
            ->count();
    }

    public function totalFinesByDate($date)
    {
        return $this->transaction
            ->where('status', 'overdue')
            ->whereDate('created_at', $date)
            ->sum('fine');
    }

    public function getByMonth($month, $year)
    {
        return $this->transaction
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->get();
    }

//    public function countGroupByDate()
//    {
//        $date = Carbon::today()->subDay(30);
//        return $this->transaction
//            ->where('created_at', '>=', $date)
//            ->get()
//            ->groupBy(function ($data) {
//                return $data->created_at->format('Y-m-d');
//            });
//    }
}
