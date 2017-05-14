@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if($files->count() > 0)
                @foreach($files as $file)
                    <div class="col-md-8">
                        <a href="{{ route('file.show', ['id' => $file->id]) }}">{{ $file->name }}</a>
                    </div>
                    <div class="col-md-2">
                        <a class="btn btn-primary" href="{{ url('/file/download/' . $file->id)}}" download="{{ $file->name }}">Download</a>
                    </div>
                    <div class="col-md-2">
                        <form action="{{ route('file.destroy', ['id' => $file->id]) }}" method="POST">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </div>
                @endforeach
            @else
                <div class="col-md-12">
                    <h3>Fișierul nu există</h3>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection