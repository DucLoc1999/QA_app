@extends('layout.head_new')

@section('title')
    Tạo khảo sát
@endsection
@section('body')
    @include('layout.header_bar')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tạo khảo sát</div>

                    <div class="card-body">
                        <form method="POST" action="{{URL::to('/survey')}}">
                            @csrf
                            <input type="hidden" name="session_id" value="{{$session_id}}">
                            <input type="hidden" name="action" value="create">
                            <div class="form-group row">
                                <label for="content" class="col-md-3 col-form-label text-md-right">
                                    Nội dung khảo sát:
                                </label>

                                <div class="col-md-9">
                                    <textarea id="content" class="form-control" name="content" style="height: 120px"placeholder="" required autofocus></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="option_1" class="col-md-3 col-form-label text-md-right">
                                    Lựa chọn 1:
                                </label>

                                <div class="col-md-9">
                                    <input id="option_1" type="text" class="form-control" name="option_1" required>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="option_2" class="col-md-3 col-form-label text-md-right">
                                    Lựa chọn 2:
                                </label>

                                <div class="col-md-9">
                                    <input id="option_2" type="text" class="form-control" name="option_2" required>

                                </div>
                            </div>
                            <label class="col-md-3 col-form-label text-md-right hover-blue" onclick="moreOption(this, 3)">
                                <i style="margin-right: 5px" class="fas fa-plus-circle"></i>
                                Thêm lựa chọn
                            </label>

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

@section('script')
    <script>
        function moreOption(element, num) {
            var label = document.createElement('label');
            label.for = "option_"+num;
            label.className = "col-md-3 col-form-label text-md-right";
            label.innerHTML = "Lựa chọn "+num+":";
            var input = document.createElement('input');
            input.id = "option_"+num;
            input.type = "text";
            input.className = "form-control";
            input.name = "option_"+num;
            input.required;
            input.focus();
            var div = document.createElement('div');
            div.className = "col-md-9";
            div.append(input);
            var option = document.createElement('div');
            option.className = "form-group row";
            option.append(label, div);

            element.setAttribute( "onClick", "moreOption(this, "+(num+1)+")");
            element.before(option);
        }
    </script>
@endsection
