@extends('layouts.backend.main')

@section('title', 'MyBlog | Edit post')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Blog
                <small>Edit post</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('/home') }}" class="active"><i class="fa fa-dashboard"></i> Dashboard </a>
                </li>

                <li><a href="{{ route('blog.index') }}">Blog</a> </li>

                <li class="active">Edit post</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">

                {!! Form::model($post, [

                       'method'=>'PUT',
                       'route'=>['blog.update', $post->id ],
                       'files' => TRUE,
                       'id' => 'post-form'

                       ]) !!}


             @include('backend.blog.form')
                <!-- /.box -->
                {!! Form::close() !!}
            </div>
        </section>
    </div>
    <!-- ./row -->

    <!-- /.content -->



@endsection

@include('backend.blog.script')

