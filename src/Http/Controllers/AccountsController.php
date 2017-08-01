<?php

namespace AccessManager\Accounts\Http\Controllers;


use AccessManager\Accounts\Http\Requests\CustomerAccountRequest;
use AccessManager\Accounts\Models\Account;
use AccessManager\Base\Http\Controller\AdminBaseController;

/**
 *  This class takes care of all the operations related to customer accounts, which
 * includes creating, updating, deleting and showing the list of present
 * accounts in the database.
 * Class AccountsController
 * @package AccessManager\Accounts\Http\Controllers
 */
class AccountsController extends AdminBaseController
{
    /**
     * Fetch and present the list of accounts, with pagination.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        $accounts = Account::paginate(10);
        return view('Accounts::index', compact('accounts'));
    }

    /**
     * Present the form to create a new customer account.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAdd()
    {
        return view('Accounts::add-edit');
    }

    public function postAdd( CustomerAccountRequest $request )
    {
        try {
            Account::add($request);
            return redirect()->route('accounts.index');
        }
        catch (\Exception $e)
        {
            dd($e->getMessage());
        }
    }

    public function getEdit($username)
    {
        try {
            $account = Account::findForEdit($username);
            return view("Account::add-edit", compact('account'));
        }
        catch (\Exception $e)
        {
            dd($e->getMessage());
        }
    }

    public function postEdit($username)
    {

    }

    public function postDelete($username)
    {

    }
}