@extends('layout.head_new')

@section('title')
    Kiểm tra mật khẩu phiên
@endsection
@section('body')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Phiên hỏi đáp yêu câu mật khẩu: </div>

                    <div class="card-body">
                        <form method="POST" action="{{URL::to('session/check_password')}}">
                            @csrf
                            <input type="hidden" name="session_id" value="{{$session_id}}">

                            <div class="form-group row">
                                <label for="password" class="col-md-3 col-form-label text-md-right">
                                    Nhập mật khẩu:
                                </label>
                                <div class="col-md-8">
                                    <input id="password" type="password" class="form-control" name="password" required autofocus>
                                    @if($errors->any())
                                        <span class="invalid-feedback" style="display: block">
                                            <strong>{{$errors->first()}}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Vào phiên
                                    </button>
                                    <a class="btn btn-danger" style="height: 38px;padding: 6px 12px;" href="{{URL::to('/session')}}">
                                        Hủy
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
