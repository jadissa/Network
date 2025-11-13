<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $table = 'requests';
    protected $primaryKey = 'ip_address';
    public $incrementing = false; // Primary key is not auto-incrementing
    protected $keyType = 'string';
    protected $fillable = ['server_hostname', 'ip_address', 'origin', 'location', 'whois', 'process', 'comments', 'reviewed'];
}