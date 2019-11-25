@extends('layout.head_new')

@section('title')
    Tạo phiên hỏi đáp
@endsection

@section('body')
    @include('layout.header_bar')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Tạo phiên hỏi đáp
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{URL::to('/session')}}">
                            @csrf
                            <div class="form-group row">
                                <label for="topic" class="col-md-3 col-form-label text-md-right">
                                    Chủ đề của phiên:
                                </label>

                                <div class="col-md-9">
                                    <textarea id="topic" class="form-control" name="topic" style="height: 120px"placeholder="" required autofocus></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-3 col-form-label text-md-right">
                                    Mật khẩu phiên:
                                </label>

                                <div class="col-md-9">
                                    <input id="password" class="form-control" name="password">

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="close_time" class="col-md-3 col-form-label text-md-right">
                                    Thời gian đóng:
                                </label>

                                <div class="col-md-9">
                                    <input class="form-control" name="close_time" type="datetime-local" style="width: 250px" required>

                                </div>

                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Tạo
                                    </button>
                                    <button class="btn btn-danger" onclick="window.history.back();">
                                        Hủy
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

