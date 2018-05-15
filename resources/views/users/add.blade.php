<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="https://cdn.bootcss.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style media="screen">
      * {
        padding: 0;
        margin: 0;
      }
      .container {
        padding: 20px;
      }
      .form-group {
        position: relative;
      }
      .form-control {
        width: 300px;
      }
      label.error {
        position: absolute;
        left: 310px;
        top: 35px;
        font-size: 12px;
        font-weight: 100;
        color: #d9534f;
    }
    </style>
  </head>
  <body>

    <div class="container">
      <div class="row">
        <div class="col-md-5">
          <form class="add-form" action="javascript:;">
            {{csrf_field()}}
            <fieldset>
              <legend>新增用户</legend>
              <div class="form-group">
                <label for="name">用户名</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="请输入用户名">
              </div>
              <div class="form-group">
                <label for="password">密码</label>
                <input type="text" class="form-control" name="password" id="password" placeholder="请输入密码">
              </div>
              <div class="form-group">
                <label for="email">邮箱</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="请输入邮箱">
              </div>
              <input type="submit" class="btn btn-primary btn-sm" value="提交">
            </fieldset>
          </form>
        </div>
      </div>
    </div>

    <script src="https://cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/jquery-validate/1.17.0/jquery.validate.min.js"></script>
    <script src="https://cdn.bootcss.com/jquery-validate/1.17.0/localization/messages_zh.js"></script>
    <script type="text/javascript">
        $(".add-form").validate({
          rules: {
            name: {
              required: true
            },
            password: {
              required: true
            },
            email: {
              required: true,
              email: true
            }
          },
          messages: {
            name: {
              required: "请输入用户名"
            },
            password: {
              required: "请输入密码"
            },
            email: {
              required: "请输入邮箱",
              email: "请输入正确的邮箱格式"
            }
          },
          submitHandler: function() {
            $.ajax({
              url: "user_store",
              type: "post",
              data: $(".add-form").serialize(),
              dataType: "json",
              success: function(data) {
                if(data.code == 200) {
                  alert("操作成功");
                  window.location.href="{{route('user.index')}}";
                } else {
                  alert(data.msg);
                }
              }
            });
          }
        });
    </script>
  </body>
</html>
