@extends('layouts.app')

@section('content')
<link href="{{ asset('css/bootstrap-tagsinput.css') }}" rel="stylesheet">
<script src="{{ asset('js/bootstrap-tagsinput.js') }}"></script>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Adaugă fișier</div>
                <div class="panel-body">
                    @if (Session::has("message"))
                       {{ Session::get("message") }}
                    @endif
                    <form method="POST" action="{{ route('file.store') }}" class="form-horizontal custm-form" role="form"  enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Nume:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="name" placeholder="Introduceți numele" name="name">
                                </div>

                                  <label class="control-label col-md-3">Etichete:</label>

                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="word" placeholder="Cuvânt" name="tags" data-role="tagsinput">

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" name="file">Adaugă fișier:</label>
                                <div class="col-md-8">
                                    <input  type="file" id="file" placeholder="Fișier" name="file" class=""/>
                                    <!-- <span class="required" id='spnFileError'></span> -->
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="btnUpload" class="custm-btn btn-primary" onclick="uploadFile();">Încarcă</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).on('keyup keypress', 'form input[type="text"]', function(e) {
  if(e.which == 13) {
    e.preventDefault();
    return false;
  }
});
</script>
@endsection
