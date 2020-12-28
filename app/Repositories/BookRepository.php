<?php

namespace App\Repositories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BookRepository implements BaseRepository
{
    private $book;

    public function __construct()
    {
        $this->book = new Book();
    }

    public function getAll()
    {
        return $this->book->all();
    }

    public function findById($id)
    {
        // TODO: Implement findById() method.
    }

    public function create(array $data)
    {
        return $this->book->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->book->findOrFail($id)->update($data);
    }

    public function delete($id)
    {
        return $this->book->findOrFail($id)->delete();
    }

    public function getAvailable()
    {
        return $this->book->whereDoesntHave('transactions', function (Builder $query) {
            $query->where('status', 'active');
        })->get();
    }

    public function countAll()
    {
        return $this->book->all()->count();
    }
}
