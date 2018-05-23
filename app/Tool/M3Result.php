<?php

namespace App\Tool;

class M3Result
{
  public static function init($ret = '', $result = '')
  {
    return json_encode(array(
        'code' => is_array($ret) ? $ret[0] : $ret,
        'msg'  => is_array($ret) ? $ret[1] : $ret,
        'data' => $result
    ), JSON_UNESCAPED_UNICODE);
  }
}
