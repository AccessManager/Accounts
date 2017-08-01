<?php

Route::group([
    'namespace'     =>      'AccessManager\Accounts\Http\Controllers',
    'prefix'        =>      'accounts',
], function(){

    Route::get('/', [
        'as'    =>      'accounts.index',
        'uses'  =>      'AccountsController@getIndex',
    ]);

    Route::get('/new', [
        'as'    =>      'accounts.add.get',
        'uses'  =>      'AccountsController@getAdd',
    ]);

    Route::post('/new', [
        'as'    =>      'accounts.add.post',
        'uses'  =>      'AccountsController@postAdd'
    ]);

    Route::get('{username}/modify', [
        'as'    =>      'accounts.edit.get',
        'uses'  =>      'AccountsController@getEdit',
    ]);

    Route::post('{username}/modify', [
        'as'    =>      'accounts.edit.post',
        'uses'  =>      'AccountsController@postEdit',
    ]);

    Route::post('{username}/remove', [
        'as'    =>      'accounts.delete.post',
        'uses'  =>      'AccountsController@postDelete',
    ]);
});