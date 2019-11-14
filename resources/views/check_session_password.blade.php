<html>
<head>
    <title> Kiểm tra mật khẩu phiên</title>
</head>
<body>
<div style="border-width: 5px; display: block; height: 500px; width: 300px; border-style: solid;">

    <form method="POST" action="{{URL::to('/session/check password')}}" style="height: 100%; width: 100%">
        @csrf
        <input type="hidden" name="session_id" type="number" value="{{$session_id}}">
        <input type="hidden" name="question_id" type="number" value="{{$question_id}}">
        <input name="password" type="text">
        <button type="submit">gửi</button>

    </form>
</div>
</body>
</html>
