@extends('layouts.default')
@section('title', 'Список задач - Example')
@section('content')
    @include('includes.nav')
    @if($tasks->isNotEmpty())
        <div class="d-flex flex-wrap">
            @foreach($tasks as $task)
                @include('includes.card')
            @endforeach
        </div>
        {{ $tasks->links('pagination.bootstrap-5') }}
    @endif
@endsection
