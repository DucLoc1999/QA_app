@extends('layout.head')

@include('layout.header')
<div style="border-width: 5px; display: block; height: 500px; width: 300px; border-style: solid;">

    <form method="POST" action="{{URL::to('/session')}}" style="height: 100%; width: 100%">
        @csrf
        <input type="hidden" name="action">
        <input name="creator_id" type="number">
        <input name="topic" type="text">
        <input name="password" type="text">
        <input name="close_time" type="text">
        <button type="submit">gửi</button>

    </form>
</div>
@include('layout.footer')
