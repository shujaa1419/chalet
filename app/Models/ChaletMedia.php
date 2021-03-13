<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChaletMedia extends Model
{
    protected $guarded = [];
    protected $table = 'chalet_media';

    public function chalet()
    {
        return $this->belongsTo(Chalet::class);
    }
}
