@extends('layouts.backend.main')

@section('title', 'MyBlog | Categories')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Categories
                <small>Display all categories</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('/home') }}" class="active"><i class="fa fa-dashboard"></i> Dashboard </a>
                </li>

                <li><a href="{{ route('categories.index') }}"></a> Categories</li>

                <li class="active">All Categories</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="pull-left">
                                <a href="{{ route('categories.create') }}" class="btn btn-success"><i class="fa fa-plus"></i>
                                    Add New</a>
                            </div>

                            <div class="pull-right" >

                            </div>
                        </div>
                        <!-- /.box-header -->
                        {{--                         table.table.table-boarded>thead>tr>td*5--}}
                    </div>
                    <div class="box-body ">

                        @include('backend.partials.message')



                        @if(! $categories->count())
                            <div class="alert alert-danger">
                                <strong>No record found</strong>
                            </div>
                        @else


                                @include('backend.categories.table')
                        @endif




                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer clearfix">

                        <div class="pull-left">
                            {{$categories->appends(Request::query())->render() }}

                        </div>

                        <div class="pull-right">

                            <small>{{ $categoriesCount }} {{ str_plural('Item', $categoriesCount) }}</small>
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

