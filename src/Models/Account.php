<?php

namespace AccessManager\Accounts\Models;


use AccessManager\Accounts\Http\Requests\CustomerAccountRequest;
use AccessManager\Base\Models\AdminBaseModel;
use AccessManager\Helpers\StringToArrayParser;
use AccessManager\AccountDetails\AccountSubscription\Models\AccountSubscription;
use AccessManager\Prepaid\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class Account
 * @package AccessManager\Accounts
 */
class Account extends AdminBaseModel
{
    /**
     * define the model properties allowed for mass assignment.
     *
     * @var array
     */
    protected $fillable = ['username', 'password', 'fname', 'lname', 'address', 'zone_id', ];

    /**
     * defines relationship with AccountPhone model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function phoneNumbers()
    {
        return $this->hasMany(AccountPhone::class);
    }

    /**
     * defines relationship with AccountEmail model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function emailAddresses()
    {
        return $this->hasMany(AccountEmail::class);
    }

    /**
     * defines relationship with AccountSubscription model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subscriptions()
    {
        return $this->hasMany(AccountSubscription::class);
    }

    /**
     * handles record creation for new customer account
     * along with their phone numbers & email addresses.
     *
     * @param CustomerAccountRequest $request
     * @return mixed
     */
    public static function add( CustomerAccountRequest $request )
    {
      return  DB::transaction(function()use($request){

            $account = new static(
                $request->only('username', 'fname', 'lname', 'address', 'zone_id')
            );
            $account->password = bcrypt($request->password);
            $account->saveOrFail();

            if( $request->phone != null ):
                $phoneNumbers = (new StringToArrayParser($request->phone))->parseToArray();
                foreach ($phoneNumbers as $phone )
                {
                    $account->phoneNumbers()->create(['number'=>$phone]);
                }
            endif;

            if( $request->email != null ):
                $emailAddresses = (new StringToArrayParser($request->email))->parseToArray();
                foreach( $emailAddresses as $email )
                {
                    $account->emailAddresses()->create(['address'=>$email]);
                }
            endif;
        });
    }

    /**
     * Find & prepare the account model to populate edit form.
     *
     * @param $username
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public static function findForEdit( $username )
    {
        $account = static::query()->where('username', $username)->firstOrFail();
        if( count($account->phoneNumbers) )
        {
            $account->phone = implode(',', $account->phoneNumbers->pluck('number')->toArray());
        }
        if( count($account->emailAddresses) )
        {
            $account->email = implode(',', $account->emailAddresses->pluck('address')->toArray());
        }

        return $account;
    }

    /**
     * save the account information received from edit form into database.
     *
     * @param Request $request
     */
    public function postEdit( Request $request )
    {
        DB::transaction(function() use($request){
            $this->fill(
                $request->only('zone_id', 'fname', 'lname', 'address')
            );
            $this->saveOrFail();

            $this->phoneNumbers()->delete();
            $this->emailAddresses()->delete();

            if( $request->phone != null ):

                $phoneNumbers = (new StringToArrayParser($request->phone))->parseToArray();
                foreach ($phoneNumbers as $number )
                {
                    $this->phoneNumbers()->create(['number'=>$number]);
                }
            endif;

            if( $request->email != null ):

                $emailAddresses = (new StringToArrayParser($request->email))->parseToArray();
                foreach( $emailAddresses as $address )
                {
                    $this->emailAddresses()->create(['address'=>$address]);
                }
            endif;
        });
    }

}