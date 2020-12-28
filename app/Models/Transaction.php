<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\CarbonTimeZone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $primaryKey = 'id';

    protected $fillable = [
        'book_id',
        'member_id',
        'return_date',
        'fine',
        'status',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }

    public function getReturnAttribute()
    {
        return Carbon::parse($this->return_date)->locale('id_ID')->translatedFormat('d F Y');
    }

    public function getStatusDisplayAttribute()
    {
        switch ($this->status) {
            case "active":
                return "<span class='badge badge-primary'>Active</span>";
            case "canceled":
                return "<span class='badge badge-warning'>Canceled</span>";
            case "finished":
                return "<span class='badge badge-success'>Finished</span>";
            case "overdue":
                return "<span class='badge badge-danger'>Overdue</span>";
        }
    }
}
