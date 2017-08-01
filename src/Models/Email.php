<?php

namespace AccessManager\Accounts\Models;


use AccessManager\Base\Models\AdminBaseModel;

class Email extends AdminBaseModel
{
    protected $table = 'account_emails';
    protected $fillable = ['address', 'account_id'];
    public $timestamps = false;
}