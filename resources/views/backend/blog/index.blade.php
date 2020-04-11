@extends('layouts.backend.main')

@section('title', 'MyBlog | Blog Index')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Blog
                <small>Display all blog posts</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('/home') }}" class="active"><i class="fa fa-dashboard"></i> Dashboard </a>
                </li>

                <li><a href="{{ route('blog.index') }}"></a> Blog</li>

                <li class="active">All posts</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="pull-left">
                                <a href="{{ route('blog.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Add New</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        {{--                         table.table.table-boarded>thead>tr>td*5--}}
                    </div>
                    <div class="box-body ">

                        @if(session('message'))
                            <div class="alert alert-info">
                                {{ session('message') }}
                            </div>

                        @endif
                        @if(! $posts->count())
                            <div class="alert alert-danger">
                                <strong>No record found</strong>
                            </div>
                        @else





                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <td width="80">Action</td>
                                    <td>Title</td>
                                    <td width="120">Author</td>
                                    <td width="150">Category</td>
                                    <td width="170">Date</td>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($posts as $post)
                                    <tr>
                                        <td>
                                            <a href="{{ route('blog.edit', $post->id) }}" class="btn btn-xs btn-default">
                                                <i class="fa fa-edit"> </i>
                                                {{--                                            {{ route('backend.blog.edit') }}--}}
                                                {{--                                        </a>--}}

                                                <a href="#" class="btn btn-xs btn-danger">
                                                    {{--                                            {{ route('backend.blog.destroy') }}--}}
                                                    <i class="fa fa-times"> </i>
                                                </a>


                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->author->name }}</td>

                                        <td>{{ $post->category->title }}</td>

                                        <td>
                                            <abbr
                                                title="{{ $post->dateFormatted(true) }}">{{$post->dateFormatted()}}</abbr>
                                            {!!  $post->publicationLabel() !!}
                                        </td>
                                    </tr>

                                @endforeach


                                </tbody>

                            </table>
                        @endif
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer clearfix">

                        <div class="pull-left">
                            {{$posts->render() }}

                        </div>

                        <div class="pull-right">

                            <small>{{ $postCount }} {{ str_plural('Item', $postCount) }}</small>
                        </div>

                    </div>
                </div>
                <!-- /.box -->
            </div>
    </div>
    <!-- ./row -->

    <!-- /.content -->



@endsection

@section('script')
    <script type="text/javascript">
        $('ul.pagination').addClass('no-margin pagination-sm');
    </script>

@endsection
