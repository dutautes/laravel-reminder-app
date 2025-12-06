<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Reminder extends Model
{
    use SoftDeletes;
    // mendaftarkan nama column selain id dan timestamps

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'due_at',
        'repeat',
        'status',
        'completed_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // casts mengubah tipe data completed_at
    protected function casts(): array
    {
        return ['completed_at' => 'datetime'];
    }
}
