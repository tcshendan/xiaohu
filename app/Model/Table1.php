<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Table1 extends Model
{
    //指定表名
    protected $table = 'table1';

    //指定id
    protected $primaryKey = 'id';

    //自动维护时间戳
    public $timestamps = true;


    protected function getDateFormat()
    {
        return time();
    }

    protected function asDateTime()
    {
        return $val;
    }
}
