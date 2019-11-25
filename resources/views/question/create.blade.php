@extends('layout.head_new')

@section('title')
    Tạo câu hỏi
@endsection


@section('body')
    @include('layout.header_bar')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Tạo câu hỏi
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{URL::to('/question')}}">
                            @csrf
                            <input type="hidden" name="session_id" value="{{$session_id}}">
                            <div class="form-group row">
                                <label for="content" class="col-md-3 col-form-label text-md-right">
                                    Câu hỏi cảu bạn:
                                </label>

                                <div class="col-md-9">
                                    <textarea id="content" class="form-control" name="content" style="height: 120px"placeholder="" required autofocus></textarea>
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

