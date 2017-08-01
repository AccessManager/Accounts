@extends('Base::layout')
@section('header')
    Customer Accounts
@endsection
@section('box-header')
    New Account
@endsection

@section('content')
    @if( isset($account) )
        {!! Form::model($account, ['route'=>'admin.accounts.post-edit']) !!}
        {!! Form::hidden('id', $account->id) !!}
    @else
        {!! Form::open(['route'=>'accounts.add.post']) !!}
    @endif
    <div class="row">
        <div class="col-xs-5 col-xs-offset-2">
            <fieldset>
                <div class="form-group">
                    {!! Form::text('username', NULL, ['class'=>'form-control', 'placeholder'=>'username']) !!}
                </div>
                <div class="form-group">
                    {!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'password']) !!}
                </div>
                <div class="form-group">
                    {!! Form::text('name', NULL, ['class'=>'form-control', 'placeholder'=>'account name']) !!}
                </div>
                <div class="form-group">
                    {!! Form::text('phone', NULL, ['class'=>'form-control', 'placeholder'=>'contact number, comma separated if multiple']) !!}
                </div>
                <div class="form-group">
                    {!! Form::text('email', NULL, ['class'=>'form-control', 'placeholder'=>'email address, comma separated if multiple']) !!}
                </div>
                <div class="form-group">
                    {!! Form::textarea('address', NULL, ['class'=>'form-control', 'placeholder'=>'address', 'rows'=>4]) !!}
                </div>
                <div class="form-group">
                    <div class="col-xs-8 col-xs-offset-1">
                        <div class="btn-group">
                            <input type="submit" class="btn btn-primary" value="Submit">
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
    {!! Form::close() !!}
@endsection