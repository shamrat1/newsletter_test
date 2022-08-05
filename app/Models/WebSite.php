<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebSite extends Model
{
    use HasFactory;

    protected $fillable = [
        "name", "url", "owner"
    ];

    public function owner()
    {
        return $this->belongsTo(User::class,"owner");
    }

    public function subscribers()
    {
        return $this->hasMany(Subscription::class);
    }
}
