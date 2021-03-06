@extends('app');

@section('content')

    <div class="container">
        <div class="row">
{{--            @extends('app');--}}

{{--            @section('content')--}}

                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <article class="post-item post-detail">
                                @if($post->image_url)
                                <div class="post-item-image">
{{--                                    <a href="#">--}}
                                        <img src="{{$post->image_url}}" alt="$post->title">
{{--                                    </a>--}}
                                </div>
                                @endif

                                <div class="post-item-body">
                                    <div class="padding-10">
                                        <h1>{{$post->title}}</h1>

                                        <div class="post-meta no-border">
                                            <ul class="post-meta-group">
                                                <li><i class="fa fa-user"></i><a href="{{ route('author', $post->author->slug) }}"> {{$post->author->name}}</a></li>
                                                <li><i class="fa fa-clock-o"></i><time> {{$post->date}}</time></li>
                                                <li><i class="fa fa-folder"></i><a href="{{ route('category', $post->category->slug) }}"> {{$post->category->title}}</a></li>
                                                <li><i class="fa fa-tags"></i>{!! $post->tags_html !!}</li>

                                                <li><i class="fa fa-comments"></i><a href="#post-comments">{{ $post->commentsNumber() }}</a></li>
                                            </ul>
                                        </div>

                                        {!! $post->body_html !!}
                                    </div>
                                </div>
                            </article>

                            <article class="post-author padding-10">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img alt="{{$post->author->name}}" src="{{$post->author->gravatar() }}" class="media-object">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading"><a href="{{ route('author', $post->author->slug) }}">{{$post->author->name}}</a></h4>
                                        <div class="post-author-count">
                                            <a href="{{ route('author', $post->author->slug) }}">
                                                <i class="fa fa-clone"></i>
                                                <?php  $postCount =  $post->author->posts()->published()->count() ?>
                                                {{ $postCount }} {{ str_plural('post', $postCount) }}



                                            </a>
                                        </div>
                                        <p  > {!! $post->author->bio_html !!}</p>
                                    </div>
                                </div>
                            </article>



{{--                            comments here--}}

                            @include('blog.comments')
                        </div>
                        @include('sidebar')
                    </div>
                </div>


{{--            @endsection--}}

{{--            @include('sidebar')--}}
        </div>
    </div>


@endsection
