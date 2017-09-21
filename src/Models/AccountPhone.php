<?php

namespace AccessManager\Accounts\Models;


use AccessManager\Base\Models\AdminBaseModel;

class AccountPhone extends AdminBaseModel
{
    protected $fillable = ['number', 'account_id'];
    public $timestamps = false;
}