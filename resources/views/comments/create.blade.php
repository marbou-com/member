@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-body">



        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('comments.store') }}" method="POST">
            
        @csrf


        <div class="form-group">
            <label class="form-check-label" for="exampleCheck1">内容</label>
            <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
        </div>

        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        <input type="hidden" name="post_id" value="{{ $post_id }}">

        <button type="submit" class="btn btn-primary">登録</button>
        </form>

    </div>
</div>

@endsection

