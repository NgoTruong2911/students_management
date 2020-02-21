<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\Faculty\FacultyEloquentRepository;
use App\Http\Requests\Faculties\CreateFacultyRequest;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $facultyEloquentRepository;

    public function __construct(FacultyEloquentRepository $facultyEloquentRepository)
    {
        $this->facultyEloquentRepository = $facultyEloquentRepository;
    }

    public function index()
    {
        $users = User::all();
        $faculties = $this->facultyEloquentRepository->getAll();
        return view('faculties.index', compact('faculties', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('faculties.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFacultyRequest $request)
    {
        $data = $request->all();
        $faculty = $this->facultyEloquentRepository->create($data);
        return redirect()->route('faculties.index')->with('status', 'Create Successful');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $faculty = $this->facultyEloquentRepository->find($id);
        return view('faculties.show', compact('faculty'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faculty = $this->facultyEloquentRepository->find($id);
        return view('faculties.edit', compact('faculty'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateFacultyRequest $request, $id)
    {
        $req = $request->all();
        $save = $this->facultyEloquentRepository->update($id, $req);
        return redirect()->route('faculties.index')->with('status', 'Update Successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->facultyEloquentRepository->delete($id);
        return redirect()->route('faculties.index')->with('status', 'Delete Successful');
    }
}
