<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];

    public function chalet(){
        return $this->belongsTo(Chalet::class);
    }

    public function status()
    {
        return $this->status == 1 ? 'Active' : 'Inactive';
    }
}
