<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>用户列表</title>
    <link href="https://cdn.bootcss.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style media="screen">
      * {
        padding: 0;
        margin: 0;
      }
      .list {
        padding: 20px;
      }
      table tr th, table tr td {
        text-align: center;
      }
    </style>
  </head>
  <body>
    <div class="list">
      <div style="margin: 15px 0">
        <a href="{{route('user.add')}}" class="btn btn-primary btn-sm">+新增</a>
      </div>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>姓名</th>
            <th>密码</th>
            <th>邮箱</th>
            <th>创建时间</th>
            <th>更新时间</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
          @if(!$users->isEmpty())
            @foreach($users as $item)
            <tr>
              <td>{{$item->id}}</td>
              <td>{{$item->name}}</td>
              <td>{{$item->password}}</td>
              <td>{{$item->email}}</td>
              <td>{{$item->created_at}}</td>
              <td>{{$item->updated_at}}</td>
              <td>
                <a href="javascript:;" class="btn btn-primary btn-sm j-delete-item" data-id="{{$item->id}}">删除</a>
              </td>
            </tr>
            @endforeach
          @endif
        </tbody>
      </table>
    </div>

    <script src="https://cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript">
      $(".j-delete-item").click(function() {
        if(confirm("确定要删除当前用户吗?")) {
          $.ajax({
            url: "user_delete",
            type: "post",
            data: {"_token": "{{ csrf_token() }}", "id": $(this).attr('data-id')},
            dataType: "json",
            success: function(data) {
              if(data.code == 200) {
                alert('删除成功');
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
