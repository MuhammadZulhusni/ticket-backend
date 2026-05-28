<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'subject',
        'requester_name',
        'requester_email',
        'status',
        'priority',
        'description',
    ];
}