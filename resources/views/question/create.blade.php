@extends('layout.head')

@include('layout.header')
<div style="border-width: 5px; display: block; height: 500px; width: 300px; border-style: solid;">

    <form method="POST" action="{{URL::to('/question')}}" style="height: 100%; width: 100%">
        @csrf
        <input name="asker_id" type="number">
        <input name="content" type="text">
        <input name="session_id" type="text">
        <button type="submit">gửi</button>

    </form>
</div>
@include('layout.footer')
