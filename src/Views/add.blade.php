@extends('Base::layout')
@section('header')
    Customer Accounts
@endsection
@section('box-header')
    New Account
@endsection

@section('content')
    {!! Form::open(['route'=>'accounts.add.post','class'=>'form-horizontal']) !!}
    <div class="row">
        <div class="col-xs-5 col-xs-offset-1">

            <fieldset>
                <p class="text-primary">
                    login credentials
                </p>
                <div class="form-group">
                    <div class="col-xs-8">
                        {!! Form::text('username', NULL, ['class'=>'form-control','placeholder'=> 'username']) !!}
                        <span class="help-block">
							{!! $errors->first('username') !!}
						</span>
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-xs-8">
                        {!! Form::password('password', ['class'=>'form-control','placeholder'=> 'password']) !!}
                        <span class="help-block">
							{!! $errors->first('password') !!}
						</span>
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-xs-8">
                        {!! Form::password('confirm_password', ['class'=>'form-control','placeholder'=> 'confirm password']) !!}
                        <span class="help-block">
							{!! $errors->first('confirm_password') !!}
						</span>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="col-xs-5">
            <fieldset>
                <p class="text-primary">
                    account information
                </p>
                <div class="form-group">
                    <div class="col-xs-8">
                        {!! Form::select('zone_id', $zones, NULL, ['class'=>'form-control', 'data-title'=>'Select Zone']) !!}
                    </div>
                </div>
                <div class="form-group individual">
                    <div class="col-xs-8">
                        {!! Form::text('fname',NULL,['class'=>'form-control','placeholder'=>'first name']) !!}
                        <span class="help-block">
							{!! $errors->first('fname') !!}
						</span>
                    </div>
                </div>
                <div class="form-group individual">
                    <div class="col-xs-8">
                        {!! Form::text('lname',NULL,['class'=>'form-control','placeholder'=>'last name']) !!}
                        <span class="help-block">
							{!! $errors->first('lname') !!}
						</span>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-8 col-xs-offset-1">
            <hr>
            <p class="text-primary">
                contact details
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-5 col-xs-offset-1">
            <div class="form-group">
                <div class="col-xs-8">
                    {!! Form::text('phone',NULL,['class'=>'form-control','placeholder'=>'comma separated phone numbers']) !!}
                    <span class="help-block">
							{!! $errors->first('phone') !!}
						</span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-8">
                    {!! Form::text('email',NULL,['class'=>'form-control','placeholder'=>'email address']) !!}
                    <span class="help-block">
                        {!! $errors->first('email') !!}
                    </span>
                </div>
            </div>
        </div>
        <div class="col-xs-5">
            <div class="form-group">
                <div class="col-xs-8">
                    {!! Form::textarea('address',NULL,['class'=>'form-control','placeholder'=>'billing address','rows'=>6,]) !!}
                    <span class="help-block">
							{!! $errors->first('address') !!}
						</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <fieldset>
                <div class="form-group">
                    <div class="col-xs-4 col-xs-offset-3">
                        <button class="btn btn-lg btn-flat bg-orange-active btn-block">Submit</button>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
    {!! Form::close() !!}
@endsection