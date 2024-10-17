<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $guarded = [];
    // protected $visible = ['id'];
    // protected $hidden = ['updated_at'];
    public function user () {
        return $this->belongsTo(User::class);
    }
}
