@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @foreach($files as $file)
                <div class="col-md-8">
                    <a href="{{ route('file.show', ['id' => $file->id]) }}">{{ $file->name }}</a>
                </div>
                <div class="col-md-4">
                    <form action="{{ route('file.destroy', ['id' => $file->id]) }}" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection