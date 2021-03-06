@extends('layouts.backend.main')

@section('title', 'MyBlog | Categories')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Users
                <small>Display all Users</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('/home') }}" class="active"><i class="fa fa-dashboard"></i> Dashboard </a>
                </li>

                <li><a href="{{ route('users.index') }}"></a> Users</li>

                <li class="active">All Users</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="pull-left">
                                <a href="{{ route('users.create') }}" class="btn btn-success"><i class="fa fa-plus"></i>
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



                        @if(! $users->count())
                            <div class="alert alert-danger">
                                <strong>No record found</strong>
                            </div>
                        @else


                                @include('backend.users.table')
                        @endif




                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer clearfix">

                        <div class="pull-left">
                            {{$users->appends(Request::query())->render() }}

                        </div>

                        <div class="pull-right">

                            <small>{{ $usersCount }} {{ str_plural('Item', $usersCount) }}</small>
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

