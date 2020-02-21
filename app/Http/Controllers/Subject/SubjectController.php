<?php

namespace App\Http\Controllers\Subject;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\Subject\SubjectEloquentRepository;
use App\Http\Requests\Subjects\CreateSubjectRequest;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $subjectEloquentRepository;

    public function __construct(SubjectEloquentRepository $subjectEloquentRepository)
    {
        $this->subjectEloquentRepository = $subjectEloquentRepository;
    }

    public function index()
    {
        $subjects = $this->subjectEloquentRepository->search(5);
        return view('subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subjects.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSubjectRequest $request)
    {
        $data = $request->all();
        $subjects = $this->subjectEloquentRepository->create($data);

        return redirect()->route('subjects.index')->with('status', 'Create Successful');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subject = $this->subjectEloquentRepository->find($id);
        return view('subjects.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subject = $this->subjectEloquentRepository->find($id);
        return view('subjects.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateSubjectRequest $request, $id)
    {
        $req = $request->all();
        $save = $this->subjectEloquentRepository->update($id, $req);
        return redirect()->route('subjects.index')->with('status', 'Update Successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->subjectEloquentRepository->delete($id);
        return redirect()->route('subjects.index')->with('status', 'Delete Successful');
    }
}
