<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatecontactsAPIRequest;
use App\Http\Requests\API\UpdatecontactsAPIRequest;
use App\Models\contacts;
use App\Repositories\contactsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class contactsController
 * @package App\Http\Controllers\API
 */

class contactsAPIController extends AppBaseController
{
    /** @var  contactsRepository */
    private $contactsRepository;

    public function __construct(contactsRepository $contactsRepo)
    {
        $this->contactsRepository = $contactsRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/contacts",
     *      summary="Get a listing of the contacts.",
     *      tags={"contacts"},
     *      description="Get all contacts",
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
     *                  @SWG\Items(ref="#/definitions/contacts")
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
        $contacts = $this->contactsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            $contacts->toArray(),
            __('messages.retrieved', ['model' => __('models/contacts.plural')])
        );
    }

    /**
     * @param CreatecontactsAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/contacts",
     *      summary="Store a newly created contacts in storage",
     *      tags={"contacts"},
     *      description="Store contacts",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="contacts that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/contacts")
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
     *                  ref="#/definitions/contacts"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatecontactsAPIRequest $request)
    {
        $input = $request->all();

        $contacts = $this->contactsRepository->create($input);

        return $this->sendResponse(
            $contacts->toArray(),
            __('messages.saved', ['model' => __('models/contacts.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/contacts/{id}",
     *      summary="Display the specified contacts",
     *      tags={"contacts"},
     *      description="Get contacts",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of contacts",
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
     *                  ref="#/definitions/contacts"
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
        /** @var contacts $contacts */
        $contacts = $this->contactsRepository->find($id);

        if (empty($contacts)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/contacts.singular')])
            );
        }

        return $this->sendResponse(
            $contacts->toArray(),
            __('messages.retrieved', ['model' => __('models/contacts.singular')])
        );
    }

    /**
     * @param int $id
     * @param UpdatecontactsAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/contacts/{id}",
     *      summary="Update the specified contacts in storage",
     *      tags={"contacts"},
     *      description="Update contacts",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of contacts",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="contacts that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/contacts")
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
     *                  ref="#/definitions/contacts"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatecontactsAPIRequest $request)
    {
        $input = $request->all();

        /** @var contacts $contacts */
        $contacts = $this->contactsRepository->find($id);

        if (empty($contacts)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/contacts.singular')])
            );
        }

        $contacts = $this->contactsRepository->update($input, $id);

        return $this->sendResponse(
            $contacts->toArray(),
            __('messages.updated', ['model' => __('models/contacts.singular')])
        );
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/contacts/{id}",
     *      summary="Remove the specified contacts from storage",
     *      tags={"contacts"},
     *      description="Delete contacts",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of contacts",
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
        /** @var contacts $contacts */
        $contacts = $this->contactsRepository->find($id);

        if (empty($contacts)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/contacts.singular')])
            );
        }

        $contacts->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/contacts.singular')])
        );
    }
}
