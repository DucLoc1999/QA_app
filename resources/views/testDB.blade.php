





<!-- test -->







<form method="POST" action="{{route('testDB_post')}}" style="height: 100%; width: 100%">
    @csrf
    <input name="id" type="text">
    <button type="submit">gửi</button>

</form>
