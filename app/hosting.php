<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hosting extends Model
{
    protected $fillable = [ 'hostingID','packet_name','month_price','disk_space','bandwidth',
                            'database','email','addon_domain','parked_domain','subdomain','other','brand'];
}
