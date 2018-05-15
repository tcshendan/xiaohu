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
            </tr>
            @endforeach
          @endif
        </tbody>
      </table>
    </div>
  </body>
</html>
