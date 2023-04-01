<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Society;
use App\Http\Requests\SocietyStoreRequest;
use App\Http\Resources\SocietyResource;
use App\Interfaces\SocietyRepositoryInterface;
use Auth;
use Validator;
use App\Traits\ApiResponseTraits;

class SocietyController extends BaseController
{

    private SocietyRepositoryInterface $societyRepositoryInterface;
    use ApiResponseTraits;

    /**
     * Apply default authentication middleware for backend routes.
     *
     * @return void
     */
    public function __construct(SocietyRepositoryInterface $societyRepositoryInterface)
    {
        $this->societyRepositoryInterface = $societyRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->societyRepositoryInterface->getAllSocieties();
        if (!$data) {
            $this->sendError("Not found error.", __('messages.retrieved_fail_multiple'));
        }
        return $this->sendSuccess(SocietyResource::collection($data), __('messages.retrieved_success_multiple'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\SocietyStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SocietyStoreRequest $request)
    {
        try {
            $validated = $request->validated();
            if (!$validated) {
                return $this->sendError('Validation Error.', $validated->errors());
            }
            request()->merge(['user_id' => Auth::user()->id]);
            $data = $this->societyRepositoryInterface->createSociety(request()->all());
            return $this->sendResponse(new SocietyResource($data), __('messages.create_success'));
        } catch (\Exception $e) {
            return $this->sendError('Validation Error.', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->societyRepositoryInterface->getSocietyById($id);
        if (!$data) {
            return $this->sendError("Not found error.", __('messages.retrieved_fail'));
        }
        return $this->sendSuccess(new SocietyResource($data), __('messages.retrieved_success'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SocietyStoreRequest $request, $id)
    {
        try {
            $validated = $request->validated();
            if (!$validated) {
                return $this->sendError('Validation Error...', $validated->errors());
            }
            request()->merge(['user_id' => Auth::user()->id]);
            $data = $this->societyRepositoryInterface->updateSociety($id, request()->only(["name", "user_id", "contact", "postcode", "country", "state", "city", "address", "description"]));
            return $this->sendResponse(new SocietyResource($data), __('messages.update_success'));
        } catch (\Exception $e) {
            return $this->sendError('Validation Error.', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->societyRepositoryInterface->deleteSociety($id);
        return $this->sendResponse([], __('messages.delete_success'));
    }

    /**
     * Enable the specified profession in storage.
     *
     * @param $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function enable(Request $request, $id)
    {
        $data = $this->societyRepositoryInterface->enableRecord($id);
        return $this->sendResponse(new SocietyResource($data), __('messages.enable_success'));
    }

    /**
     * Disable the specified profession in storage.
     * 
     * @param $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function disable(Request $request, $id)
    {
        $data = $this->societyRepositoryInterface->disableRecord($id);
        return $this->sendResponse(new SocietyResource($data), __('messages.disable_success'));
    }
}
