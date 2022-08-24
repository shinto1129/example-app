<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    use HasFactory;

    // public $timestanps = true;


    /**
     * 必要な道具
     */
    public function tools()
    {
        return $this->hasMany(Tool::class);
    }
}
