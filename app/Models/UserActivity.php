<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'description',
        'ref_type',
        'ref_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // helper method model, buat user activity
    public function saveActivity($action, $desc, $refType = null, $refId = null)
    {
        $this->user_id = auth()->id();
        $this->action = $action;
        $this->description = $desc;
        $this->ref_type = $refType;
        $this->ref_id = $refId;
        $this->save();
    }
}
