@extends('admin.layout.app')

@section('content')
    <div class="col-6 offset-3 mt-5">
        <div class="card-header">
            <div class="text-center">
                <img class="rounded shadow " width="400px" @if ($post->image == null) src="{{asset('image/default.jpg')}}"
            @else src="{{ asset("image/" . $post->image) }}" @endif>
            </div>
        </div>
        <div class="card-body">
            <h3 class="text-center">{{ $post->title }}</h3>
            <p class="text-start">{{ $post->description }}</p>
        </div>
        <button class="bg-dark text-white" onclick="history.back()">Back</button>
    </div>
@endsection
