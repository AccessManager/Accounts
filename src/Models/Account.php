<?php

namespace AccessManager\Accounts\Models;


use AccessManager\Accounts\Http\Requests\CustomerAccountRequest;
use AccessManager\Base\Models\AdminBaseModel;
use Illuminate\Support\Facades\DB;

class Account extends AdminBaseModel
{
    /**
     * @var array
     */
    protected $fillable = ['username', 'password', 'name', 'address'];

    /**
     * defines relationship with Phone model.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function phoneNumbers()
    {
        return $this->hasMany(Phone::class);
    }

    /**
     * defines relationship with Email model.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function emailAddresses()
    {
        return $this->hasMany(Email::class);
    }

    /**
     * handles record creation for new customer account
     * along with their phone numbers & email addresses.
     * @param CustomerAccountRequest $request
     * @return mixed
     */
    public static function add( CustomerAccountRequest $request )
    {
      return  DB::transaction(function()use($request){
            $accountData = $request->only('username', 'password', 'name', 'phone', 'email', 'address');
            $account = new static($accountData);
            $account->saveOrFail();

            $trimmedPhone = trim($request->phone, "\,\`\[\]\;");

            $phoneArray = explode(',', $trimmedPhone);

            if( count( array_filter($phoneArray) ) )
            {
                foreach ($phoneArray as $phone )
                {
                    $account->phoneNumbers()->create(['number'=>$phone]);
                }
            }

            $trimmedEmail = trim($request->email, "\,\`\[\]\;");
            $emailArray = explode(',', $trimmedEmail);
            if( count(array_filter($emailArray) ) )
            {
                foreach( $emailArray as $email )
                {
                    $account->emailAddresses()->create(['address'=>$email]);
                }
            }
        });
    }

    public static function findForEdit( $username )
    {
        $account = static::query()->where('username', $username)->firstOrFail();
        $account->phone = implode(',', $account->phoneNumbers);
        $account->email = implode(',', $account->emailAddresses);
        return $account;
    }

    public static function edit(  )
    {

    }
}