@extends('layouts.app')

@section('content')

//************************************************ formulaire message ************************************* -->

<form action="{{ route('post.store') }}" method="post">
    {{ csrf_field() }}

    <div class="field">
        <label class="label">Message</label>
        <div class="control">
            <textarea class="textarea" name="content" placeholder="Ecrivez votre message"></textarea>
        </div>
        @if ($errors->has('content'))
            <p class="help is-danger">{{ $errors->first('content') }}</p>
        @endif

        <div class="control">
            <input type="text" name="image">
        </div>
        @if ($errors->has('image'))
            <p class="help is-danger">{{ $errors->first('image') }}</p>
        @endif

        <div class="control">
            <input type="text" name="tags">
        </div>
        @if ($errors->has('tags'))
            <p class="help is-danger">{{ $errors->first('tags') }}</p>
        @endif

    </div>

    
        <div class="container">
             @foreach ($contents as $content)
                 <div class="message">
                     <h2>{{ $content->title }}</h2>
                     <p>{{ $content->content }}</p>
                     <p>Posted by: {{ $content->user->name }}</p>

                     <h3>Comments:</h3>
                    @foreach ($content->comments as $comment)
                         <p>{{ $comment->content }}</p>
                       <p>Comment by: {{ $comment->user->name }}</p>
                     @endforeach
                 </div>
             @endforeach

             <div class="field">
                 <div class="control">
                     <button class="button is-link" type="submit">Publier</button>
                 </div>
             </div>
    </form>


    <!-- Pagination -->
     {{ $contents->links() }}
    </div>
@endsection
