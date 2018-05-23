<?php

namespace App\Tool;

class ErrorCode
{
  public static $invalid_name     = [10008, '用户名不能为空'];
  public static $invalid_password = [10009, '密码不能为空'];
  public static $invalid_email    = [10010, 'email不能为空'];
}
