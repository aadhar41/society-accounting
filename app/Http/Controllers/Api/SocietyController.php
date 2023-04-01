<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Society;
use App\Http\Requests\SocietyStoreRequest;
use App\Http\Resources\SocietyResource;
use App\Interfaces\SocietyRepositoryInterface;
use Auth;

class SocietyController extends Controller
{
    private SocietyRepositoryInterface $societyRepositoryInterface;

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
            return response()->json(['success' => false, 'message' => 'Societies does not exist']);
        }

        return response()->json(['success' => true, 'societies' => SocietyResource::collection($data)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }
}
