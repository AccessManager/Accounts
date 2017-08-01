<?php

namespace AccessManager\Accounts\Models;


use AccessManager\Base\Models\AdminBaseModel;

class Phone extends AdminBaseModel
{
    protected $table = 'account_phones';
    protected $fillable = ['number', 'account_id'];
    public $timestamps = false;
}