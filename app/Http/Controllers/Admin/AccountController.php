<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\AccountDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateAccountRequest;
use App\Http\Requests\Admin\UpdateAccountRequest;
use App\Repositories\Admin\AccountRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Admin\Account;
use Response;

class AccountController extends AppBaseController
{
    /** @var  AccountRepository */
    private $accountRepository;

    public function __construct(AccountRepository $accountRepo)
    {
        $this->accountRepository = $accountRepo;
    }

    /**
     * Display a listing of the Account.
     *
     * @param AccountDataTable $accountDataTable
     * @return Response
     */
    public function index(AccountDataTable $accountDataTable,Account $account)
    {
        /**
         * get total income
         */
        $income = $account::getTotalIncome($accountDataTable);
        $expense = $account::getTotalExpense($accountDataTable);
        $balance = $income->income-$expense->expense;
        return $accountDataTable->render('admin.accounts.index',['income' => $income,'expense' => $expense,'balance' => $balance]);
    }

    /**
     * Show the form for creating a new Account.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.accounts.create');
    }

    /**
     * Store a newly created Account in storage.
     *
     * @param CreateAccountRequest $request
     *
     * @return Response
     */
    public function store(CreateAccountRequest $request)
    {
        $input = $request->all();

        $account = $this->accountRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/accounts.singular')]));

        return redirect(route('admin.accounts.index'));
    }

    /**
     * Display the specified Account.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $account = $this->accountRepository->find($id);

        if (empty($account)) {
            Flash::error(__('models/accounts.singular').' '.__('messages.not_found'));

            return redirect(route('admin.accounts.index'));
        }

        return view('admin.accounts.show')->with('account', $account);
    }

    /**
     * Show the form for editing the specified Account.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $account = $this->accountRepository->find($id);

        if (empty($account)) {
            Flash::error(__('messages.not_found', ['model' => __('models/accounts.singular')]));

            return redirect(route('admin.accounts.index'));
        }

        return view('admin.accounts.edit')->with('account', $account);
    }

    /**
     * Update the specified Account in storage.
     *
     * @param  int              $id
     * @param UpdateAccountRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAccountRequest $request)
    {
        $account = $this->accountRepository->find($id);

        if (empty($account)) {
            Flash::error(__('messages.not_found', ['model' => __('models/accounts.singular')]));

            return redirect(route('admin.accounts.index'));
        }

        $account = $this->accountRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/accounts.singular')]));

        return redirect(route('admin.accounts.index'));
    }

    /**
     * Remove the specified Account from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $account = $this->accountRepository->find($id);

        if (empty($account)) {
            Flash::error(__('messages.not_found', ['model' => __('models/accounts.singular')]));

            return redirect(route('admin.accounts.index'));
        }

        $this->accountRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/accounts.singular')]));

        return redirect(route('admin.accounts.index'));
    }
}
