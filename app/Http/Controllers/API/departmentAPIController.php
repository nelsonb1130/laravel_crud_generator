<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatedepartmentAPIRequest;
use App\Http\Requests\API\UpdatedepartmentAPIRequest;
use App\Models\department;
use App\Repositories\departmentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class departmentController
 * @package App\Http\Controllers\API
 */

class departmentAPIController extends AppBaseController
{
    /** @var  departmentRepository */
    private $departmentRepository;

    public function __construct(departmentRepository $departmentRepo)
    {
        $this->departmentRepository = $departmentRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/departments",
     *      summary="Get a listing of the departments.",
     *      tags={"department"},
     *      description="Get all departments",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/department")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $departments = $this->departmentRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            $departments->toArray(),
            __('messages.retrieved', ['model' => __('models/departments.plural')])
        );
    }

    /**
     * @param CreatedepartmentAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/departments",
     *      summary="Store a newly created department in storage",
     *      tags={"department"},
     *      description="Store department",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="department that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/department")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/department"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatedepartmentAPIRequest $request)
    {
        $input = $request->all();

        $department = $this->departmentRepository->create($input);

        return $this->sendResponse(
            $department->toArray(),
            __('messages.saved', ['model' => __('models/departments.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/departments/{id}",
     *      summary="Display the specified department",
     *      tags={"department"},
     *      description="Get department",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of department",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/department"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var department $department */
        $department = $this->departmentRepository->find($id);

        if (empty($department)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/departments.singular')])
            );
        }

        return $this->sendResponse(
            $department->toArray(),
            __('messages.retrieved', ['model' => __('models/departments.singular')])
        );
    }

    /**
     * @param int $id
     * @param UpdatedepartmentAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/departments/{id}",
     *      summary="Update the specified department in storage",
     *      tags={"department"},
     *      description="Update department",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of department",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="department that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/department")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/department"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatedepartmentAPIRequest $request)
    {
        $input = $request->all();

        /** @var department $department */
        $department = $this->departmentRepository->find($id);

        if (empty($department)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/departments.singular')])
            );
        }

        $department = $this->departmentRepository->update($input, $id);

        return $this->sendResponse(
            $department->toArray(),
            __('messages.updated', ['model' => __('models/departments.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/departments/{id}",
     *      summary="Remove the specified department from storage",
     *      tags={"department"},
     *      description="Delete department",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of department",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var department $department */
        $department = $this->departmentRepository->find($id);

        if (empty($department)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/departments.singular')])
            );
        }

        $department->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/departments.singular')])
        );
    }
}
