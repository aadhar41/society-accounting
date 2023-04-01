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
        // $this->middleware('auth');
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
            $this->sendError("Not found error.", 'Societies retrieved successfully.');
        }
        return $this->sendSuccess(SocietyResource::collection($data), 'Societies retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\SocietyStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SocietyStoreRequest $request)
    {
        // request()->merge(['user_id' => Auth::user()->id]);
        // $data = $this->societyRepositoryInterface->createSociety(request()->all());
        // if (!$data) {
        //     return response()->json(['success' => false, 'message' => 'Society not created.']);
        // }
        // return response()->json(['success' => true, 'society' => new SocietyResource($data)]);
        $validated = $request->validated();
        if (!$validated) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        request()->merge(['user_id' => Auth::user()->id]);
        $data = $this->societyRepositoryInterface->createSociety(request()->all());

        return $this->sendResponse(new SocietyResource($data), 'Society created successfully.');
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
            return $this->sendError("Not found error.", 'Societies retrieved successfully.');
        }
        return $this->sendSuccess(new SocietyResource($data), 'Societies retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
        return $this->sendResponse([], 'Product deleted successfully.');
    }
}
