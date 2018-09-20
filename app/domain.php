<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class domain extends Model
{
    protected $fillable = ['domainID', 'domain_name', 'register_price', 'transfer_price', 'renewal_price', 'brand'];
}
