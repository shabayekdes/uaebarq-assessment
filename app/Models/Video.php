<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Video extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $cast = [
        'is_send_notification' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
