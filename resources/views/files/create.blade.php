@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Adaugă fișier</div>
                <div class="panel-body">
<!--                     <form method="POST" action="apply" class="form-horizontal custm-form" role="form">
                        {!! csrf_field() !!}
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Nume:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="name" placeholder="Enter Your Name" name="name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" name="resume">Attach file:</label>
                                <div class="col-md-8">
                                    <input  type="file" id="resume" placeholder="Resume" name="resume" class=""/>
                                    <span class="required" id='spnFileError'></span>
                                </div>
                            </div>                                
                        </div>
                        <div class="modal-footer">
                            <div class="col-xs-5">
                                <p style="margin:0;text-align:left;color: green;display:none;" id="successMsg">Submitted Successfully!</p>
                            </div>
                            <button type="submit" id="btnUpload" class="custm-btn btn-primary" onclick="uploadFile();">Submit</button>
                            <button type="button" class="custm-btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </form> -->
<hr>
                    @if (Session::has("message"))
                       {{ Session::get("message") }}
                     @endif
                     <hr />
                 
                    <form action="{{ route('file.store') }}" method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <input type="text" class="form-control" id="name" placeholder="Enter Your Name" name="name">
                        <input type="file" name="file">
                        <input type="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
