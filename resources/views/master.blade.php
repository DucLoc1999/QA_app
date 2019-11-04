





<!-- test -->







@extends('layout.header_footer')

@section('body')
    <div style="border-width: 5px; display: block; height: 500px; width: 300px; border-style: solid;">
        <form method="POST" action="{{route('testDB_post')}}" style="height: 100%; width: 100%">
            @csrf
            <input name="id" type="text">
            <button type="submit">gửi</button>

        </form>

    </div>
    @if( $user ?? '' != null)
    <p>{{$user[0]['name']}}</p>
    @endif

@stop

