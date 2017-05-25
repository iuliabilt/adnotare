@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="col-md-12">
                <blockquote>
                    <div style="white-space: pre-wrap;">{{ $fileContent }}</div>
                    <footer>{{ $author }} - <cite title="Source Title">{{ $file->name }}</cite></footer>
                </blockquote>
            </div>
        </div>
    </div>
</div>
@endsection 