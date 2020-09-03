<?php

namespace App\Http\Controllers;

use App\DataTables\contactsDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatecontactsRequest;
use App\Http\Requests\UpdatecontactsRequest;
use App\Repositories\contactsRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class contactsController extends AppBaseController
{
    /** @var  contactsRepository */
    private $contactsRepository;

    public function __construct(contactsRepository $contactsRepo)
    {
        $this->contactsRepository = $contactsRepo;
    }

    /**
     * Display a listing of the contacts.
     *
     * @param contactsDataTable $contactsDataTable
     * @return Response
     */
    public function index(contactsDataTable $contactsDataTable)
    {
        return $contactsDataTable->render('contacts.index');
    }

    /**
     * Show the form for creating a new contacts.
     *
     * @return Response
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created contacts in storage.
     *
     * @param CreatecontactsRequest $request
     *
     * @return Response
     */
    public function store(CreatecontactsRequest $request)
    {
        $input = $request->all();

        $contacts = $this->contactsRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/contacts.singular')]));

        return redirect(route('contacts.index'));
    }

    /**
     * Display the specified contacts.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $contacts = $this->contactsRepository->find($id);

        if (empty($contacts)) {
            Flash::error(__('models/contacts.singular').' '.__('messages.not_found'));

            return redirect(route('contacts.index'));
        }

        return view('contacts.show')->with('contacts', $contacts);
    }

    /**
     * Show the form for editing the specified contacts.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $contacts = $this->contactsRepository->find($id);

        if (empty($contacts)) {
            Flash::error(__('messages.not_found', ['model' => __('models/contacts.singular')]));

            return redirect(route('contacts.index'));
        }

        return view('contacts.edit')->with('contacts', $contacts);
    }

    /**
     * Update the specified contacts in storage.
     *
     * @param  int              $id
     * @param UpdatecontactsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecontactsRequest $request)
    {
        $contacts = $this->contactsRepository->find($id);

        if (empty($contacts)) {
            Flash::error(__('messages.not_found', ['model' => __('models/contacts.singular')]));

            return redirect(route('contacts.index'));
        }

        $contacts = $this->contactsRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/contacts.singular')]));

        return redirect(route('contacts.index'));
    }

    /**
     * Remove the specified contacts from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $contacts = $this->contactsRepository->find($id);

        if (empty($contacts)) {
            Flash::error(__('messages.not_found', ['model' => __('models/contacts.singular')]));

            return redirect(route('contacts.index'));
        }

        $this->contactsRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/contacts.singular')]));

        return redirect(route('contacts.index'));
    }
}
