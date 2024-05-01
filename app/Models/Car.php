<?php

namespace App\Models;

use App\Enums\Cars\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $casts = [
        'status' => Status::class
    ];

    protected $guarded = [];

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function getCanDeleteAttribute() { // false or true 
        return $this->status === Status::DRAFT || $this->status === Status::CANCELED;
    }

    public function scopeOfActive($query) {
        return $query->where('status', Status::ACTIVE);
    }
}
