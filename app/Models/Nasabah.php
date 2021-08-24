<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Nasabah extends Model
{
    use HasFactory;

    public static function paginateNasabah($filter = 'id', $paginate = 1){
        return self::orderBy($filter)->paginate($paginate);
    }

    public static function getNasabah($offset, $limit, $order= 'id'){
        return self::orderBy($order)
            ->limit($limit)
            ->offset($offset)
            ->get()->toArray();
    }

    public static function getGroup($group,$label){
        return self::select($label.' as label', DB::raw('count(*) as num'))
            ->groupBy($group)
            ->get()->toArray();
    }
}
