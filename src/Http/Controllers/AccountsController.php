<?php

namespace AccessManager\Accounts\Http\Controllers;


use AccessManager\Accounts\Http\Requests\CustomerAccountRequest;
use AccessManager\Accounts\Models\Account;
use AccessManager\Base\Http\Controller\AdminBaseController;
use AccessManager\Zones\Models\Zone;
use Illuminate\Http\Request;

/**
 *  This class takes care of all the operations related to customer accounts, which
 * includes creating, updating, deleting and showing the list of present
 * accounts in the database.
 * Class AccountsController
 * @package AccessManager\Accounts
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
        $zones = Zone::pluck('name', 'id');
        return view('Accounts::add', compact('zones'));
    }

    /**
     * @param CustomerAccountRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAdd( CustomerAccountRequest $request )
    {
        try {
            Account::add($request);
            return redirect()->route('account.details', [$request->username]);
        }
        catch (\Exception $e)
        {
            dd($e->getMessage());
        }
    }

    /**
     * @param $username
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEdit($username)
    {
        try {
            $zones = Zone::pluck('name', 'id');
            $account = Account::findForEdit($username);
            return view("Accounts::edit", compact('account', 'zones'));
        }
        catch (\Exception $e)
        {
            dd($e->getMessage());
        }
    }

    /**
     * @param $username
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit($username, Request $request )
    {
        try {
            $account = Account::where('username', $username)->firstOrFail();
            $account->postEdit( $request );
            return redirect()->route('accounts.index');
        }
        catch (\Exception $e)
        {
            dd($e->getMessage());
        }
    }

    /**
     * @param $username
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDelete($username)
    {
        try {
            $account = Account::where('username', $username)->firstOrFail();
            $account->delete();
            return redirect()->route('accounts.index');
        }
        catch (\Exception $e)
        {
            dd($e->getMessage());
        }
    }
}