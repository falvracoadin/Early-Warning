<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    public static function getData($offset, $limit, $order= 'customer_identifier'){
        return self::orderBy($order)
            ->limit($limit)
            ->offset($offset)
            ->get()->toArray();
    }
}
