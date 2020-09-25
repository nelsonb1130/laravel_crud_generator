@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">
            @lang('models/accounts.plural')
        </h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('admin.accounts.create') }}">@lang('crud.add_new')</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        
        

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-3">
            <div class="alert alert-success">
                Income: {!! @$income->income !!}
                </div>
            </div>
            <div class="col-md-3">
            <div class="alert alert-danger">
                Expense: {!! @$expense->expense !!}
                </div>
            </div>
            <div class="col-md-3">
            <div class="alert alert-warning">
                Balance: {!! @$balance !!}
                </div>
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('admin.accounts.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

