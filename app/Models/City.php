<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $guarded = [];

    public function chalets(){
        return $this->hasMany(Chalet::class);
    }
}
