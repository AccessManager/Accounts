<?php

namespace AccessManager\Accounts\Models;


use AccessManager\Base\Models\AdminBaseModel;

class AccountEmail extends AdminBaseModel
{
    protected $fillable = ['address', 'account_id'];
    public $timestamps = false;
}