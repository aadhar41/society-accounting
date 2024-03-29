<?php

namespace App\Http\Controllers;

use App\Models\Society;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;
use Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\SocietyStoreRequest;
use App\Interfaces\SocietyRepositoryInterface;

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
        $this->middleware('auth');
        $this->societyRepositoryInterface = $societyRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "societies";
        $module = "society";
        $data = $this->societyRepositoryInterface->getAllSocieties();
        return view('society.index', compact('data', 'title', 'module'));
    }

    /**
     * Process datatables ajax request.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable(Request $request)
    {
        // return Datatables::of(Society::query())->make(true);

        $societydata = Society::select('societies.id', 'societies.unique_code', 'societies.name', 'societies.address', 'societies.contact', 'societies.status', 'societies.created_at', 'societies.updated_at');
        return Datatables::of($societydata)
            ->filter(function ($query) use ($request) {
                if ($request->has('status') && $request->get('status') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('societies.status', 'like', "%{$request->get('status')}%");
                    });
                }

                if ($request->has('name') && $request->get('name') != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('societies.name', 'like', "%{$request->get('name')}%");
                    });
                }

                if (!empty($request['search']['value']) && $request['search']['value'] != '') {
                    $query->where(function ($q) use ($request) {
                        $q->where('societies.name', 'like', "%{$request['search']['value']}%");
                        $q->orWhere('societies.unique_code', 'like', "%{$request['search']['value']}%");
                        $q->orWhere('societies.contact', 'like', "%{$request['search']['value']}%");
                        $q->orWhere('societies.address', 'like', "%{$request['search']['value']}%");
                        $q->orWhere('societies.status', 'like', "%{$request['search']['value']}%");
                        $q->orWhere('societies.created_at', 'like', "%{$request['search']['value']}%");
                    });
                }
            })
            ->addColumn('unique_code', function ($societydata) {
                return $unique_code = (isset($societydata->unique_code)) ? ucwords($societydata->unique_code) : "";
            })
            ->addColumn('name', function ($societydata) {
                return $name = (isset($societydata->name)) ? ucwords($societydata->name) : "";
            })
            ->addColumn('address', function ($societydata) {
                return $address = (isset($societydata->address)) ? ucwords($societydata->address) : "";
            })
            ->addColumn('contact', function ($societydata) {
                return $contact = (isset($societydata->contact)) ? ucwords($societydata->contact) : "";
            })
            ->addColumn('created_at', function ($societydata) {
                return $created_at = (isset($societydata->created_at)) ? date("F j, Y, g:i a", strtotime($societydata->created_at)) : "";
            })
            ->addColumn('status', function ($societydata) {
                return $status = (isset($societydata->status) && ($societydata->status == 1)) ? 'Enabled' : 'Disabled';
            })
            ->addColumn('action', function ($societydata) {

                $link = '
                    <div class="btn-group">
                        <a href="' . route('society.delete', $societydata->id) . '" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm(\'Do you really want to trash the entry?\');" ><i class="fas fa-trash-alt"></i></a>
                    </div>
                ';

                $activelink = '
                        <div class="btn-group">
                            <a href="' . route('admin.society.enable', $societydata->id) . '" class="btn btn-sm btn-warning" title="Enable"><i class="fas fa-lock"></i></a>
                        </div>
                    ';
                $inactivelink = '
                        <div class="btn-group">
                            <a href="' . route('admin.society.disable', $societydata->id) . '" class="btn btn-sm btn-success" title="Disable"><i class="fas fa-lock-open"></i></a>
                        </div>
                    ';

                $editlink = '
                    <div class="btn-group">
                        <a href="' . route('admin.society.edit', $societydata->id) . '" class="btn btn-sm  mt-1 mb-1 bg-pink" title="Edit" ><i class="fas fa-pencil-alt"></i></a>
                    </div>
                ';

                $final = ($societydata->status == 1) ? $editlink . $link . $inactivelink : $editlink . $link . $activelink;
                // $link = '<a href="' . route('society.delete', $societydata->id) . '" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i> Delete</a> ';
                return $final;
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = getCountries();
        $states = getState();
        $cities = getCities();
        $title = "create society";
        $module = "society";
        return view('society.create', compact('title', 'module', 'countries', 'states', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SocietyStoreRequest $request)
    {
        try {
            request()->merge(['user_id' => Auth::user()->id]);
            $this->societyRepositoryInterface->createSociety(request()->all());
            return redirect()->route('admin.society.list')->with('success', __('messages.create_success'));
        } catch (\Exception $e) {
            return redirect()->route('admin.society.create')->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Society  $society
     * @return \Illuminate\Http\Response
     */
    public function show(Society $society)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Society  $society
     * @return \Illuminate\Http\Response
     */
    public function edit(Society $society)
    {
        $countries = getCountries();
        $states = getState();
        $cities = getCities();
        $title = "society";
        $module = "society";
        $listings = $this->societyRepositoryInterface->getSocietyById($society->id);
        return view('society.edit', compact('listings', 'title', 'module', 'countries', 'states', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Society  $society
     * @return \Illuminate\Http\Response
     */
    public function update(SocietyStoreRequest $request, Society $society)
    {
        try {
            $request->request->add(['user_id' => Auth::user()->id]);
            $this->societyRepositoryInterface->updateSociety($society->id, $request->validated());
            return redirect()->route('admin.society.list')->with('success', __('messages.update_success'));
        } catch (\Exception $e) {
            return redirect()->route('admin.society.edit')->with('error', $e->getMessage());
        }
    }

    /**
     * Enable the specified society in storage.
     *
     * @param $id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Society  $society
     * @return \Illuminate\Http\Response
     */
    public function enable(Request $request, Society $society, $id)
    {
        $this->societyRepositoryInterface->enableRecord($id);
        return redirect()->route('admin.society.list')->with('success', __('messages.enable_success'));
    }

    /**
     * Disable the specified society in storage.
     * 
     * @param $id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Society  $society
     * @return \Illuminate\Http\Response
     */
    public function disable(Request $request, Society $society, $id)
    {
        $this->societyRepositoryInterface->disableRecord($id);
        return redirect()->route('admin.society.list')->with('warning', __('messages.disable_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Society  $society
     * @return \Illuminate\Http\Response
     */
    public function destroy(Society $society, $id)
    {
        $this->societyRepositoryInterface->deleteSociety($id);
        return redirect()->route('admin.society.list')->with('error', __('messages.delete_success'));
    }
}
