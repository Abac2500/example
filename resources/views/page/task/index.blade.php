@extends('layout.default')
@section('content')
    @include('include.nav')
    @if($tasks->isNotEmpty())
        <div class="d-flex flex-wrap">
            @foreach($tasks as $task)
                @include('include.task')
            @endforeach
        </div>
        {{ $tasks->links('include.paginate') }}
    @endif
@endsection
