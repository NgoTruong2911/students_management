<?php

namespace App\Http\Controllers\Point;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\User_subject;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use App\Repositories\UserSubject\UserSubjectEloquentRepository;

class PointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $userSubjectEloquentRepository;

    public function __construct(UserSubjectEloquentRepository $userSubjectEloquentRepository)
    {
        $this->userSubjectEloquentRepository = $userSubjectEloquentRepository;
    }

    public function index()
    {
        $points = $this->userSubjectEloquentRepository->getAll();
        return view('points.index', compact('points'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //     $point = $this->userSubjectEloquentRepository->find($id);
        //     return view('points.edit',compact('point'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $req = $request->all();
        // $save = $this->userSubjectEloquentRepository->update($id,$req);
        // return redirect()->route('points.index')->with('status','Update point Successful');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $this->userSubjectEloquentRepository->delete($id);
        // return redirect()->route('points.index')->with('status','Delete Successful');
    }
}
