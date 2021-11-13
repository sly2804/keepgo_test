<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Account extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_name',
    ];

    /**
     * @return HasMany
     */
    public function simCards()
    {
        return $this->hasMany(SimCard::class);
    }

    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->user_name;
    }
}
