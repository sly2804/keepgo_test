<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SimCard extends Model
{
    protected $fillable = [
        'iccid',
        'imei',
        'notes',
    ];

    /**
     * @return HasMany
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * @return string
     */
    public function getid()
    {
        return $this->id;
    }

    /**
     * Возвращает состояние сим-карты (активная/не активная)
     */
    public function isActive()
    {
        ///реализовано исключительно для проверки
        return (bool) rand(0, 1);
    }

    public function getIccid()
    {
        return $this->iccid;
    }
}

