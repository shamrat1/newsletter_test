<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id", "web_site_id"
    ];

    public function subscriber()
    {
        return $this->belongsTo(User::class,"user_id");
    }

}
