@extends('layouts.backend.main')

@section('title', 'MyBlog | Edit Category')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Category
                <small>Edit category</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('/home') }}" class="active"><i class="fa fa-dashboard"></i> Dashboard </a>
                </li>

                <li><a href="{{ route('categories.index') }}">Categories</a> </li>

                <li class="active">Edit Category</li>
            </ol>
        </section>
        j


        <!-- Main content -->
        <section class="content">
            <div class="row">

                {!! Form::model($category, [

                       'method'=>'PUT',
                       'route'=>['categories.update', $category->id ],
                       'files' => TRUE,
                       'id' => 'edit-form'

                       ]) !!}


             @include('backend.categories.form')
                <!-- /.box -->
                {!! Form::close() !!}
            </div>
        </section>
    </div>
    <!-- ./row -->

    <!-- /.content -->



@endsection

@include('backend.blog.script')

