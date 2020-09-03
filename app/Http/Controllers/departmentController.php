<?php

namespace App\Http\Controllers;

use App\DataTables\departmentDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatedepartmentRequest;
use App\Http\Requests\UpdatedepartmentRequest;
use App\Repositories\departmentRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class departmentController extends AppBaseController
{
    /** @var  departmentRepository */
    private $departmentRepository;

    public function __construct(departmentRepository $departmentRepo)
    {
        $this->departmentRepository = $departmentRepo;
    }

    /**
     * Display a listing of the department.
     *
     * @param departmentDataTable $departmentDataTable
     * @return Response
     */
    public function index(departmentDataTable $departmentDataTable)
    {
        return $departmentDataTable->render('departments.index');
    }

    /**
     * Show the form for creating a new department.
     *
     * @return Response
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created department in storage.
     *
     * @param CreatedepartmentRequest $request
     *
     * @return Response
     */
    public function store(CreatedepartmentRequest $request)
    {
        $input = $request->all();

        $department = $this->departmentRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/departments.singular')]));

        return redirect(route('departments.index'));
    }

    /**
     * Display the specified department.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $department = $this->departmentRepository->find($id);

        if (empty($department)) {
            Flash::error(__('models/departments.singular').' '.__('messages.not_found'));

            return redirect(route('departments.index'));
        }

        return view('departments.show')->with('department', $department);
    }

    /**
     * Show the form for editing the specified department.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $department = $this->departmentRepository->find($id);

        if (empty($department)) {
            Flash::error(__('messages.not_found', ['model' => __('models/departments.singular')]));

            return redirect(route('departments.index'));
        }

        return view('departments.edit')->with('department', $department);
    }

    /**
     * Update the specified department in storage.
     *
     * @param  int              $id
     * @param UpdatedepartmentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatedepartmentRequest $request)
    {
        $department = $this->departmentRepository->find($id);

        if (empty($department)) {
            Flash::error(__('messages.not_found', ['model' => __('models/departments.singular')]));

            return redirect(route('departments.index'));
        }

        $department = $this->departmentRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/departments.singular')]));

        return redirect(route('departments.index'));
    }

    /**
     * Remove the specified department from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $department = $this->departmentRepository->find($id);

        if (empty($department)) {
            Flash::error(__('messages.not_found', ['model' => __('models/departments.singular')]));

            return redirect(route('departments.index'));
        }

        $this->departmentRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/departments.singular')]));

        return redirect(route('departments.index'));
    }
}
