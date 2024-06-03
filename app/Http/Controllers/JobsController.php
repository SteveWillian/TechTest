<?php

namespace App\Http\Controllers;

use App\Models\Jobs;
use App\Repository\JobsRepository;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    protected $modelClass = Jobs::class;
    protected $repositoryClass = JobsRepository::class;

    public function show()
    {
        $data_table = $this->repository->table();

        return view('jobs.tables')
            ->with('title', "Jobs")
            ->with('subtitle', '')
            ->with('data', $data_table);
    }


    public function detail($id)
    {
        $data = $this->repository->detail($id);
        return view('jobs.detail')
            ->with('title', "Jobs")
            ->with('subtitle', '')
            ->with('data', $data);
    }

    public function create()
    {
        return view('jobs.create')
            ->with('title', "Jobs")
            ->with('subtitle', '');
    }

    public function filter(Request $request)
    {
        $filter = $request['filter'];
        return $this->repository->dataFilter($filter);
    }

    public function store(Request $request)
    {
        $this->repository->create($request);

        return back()->with('succes', 'User succesfully crated');
    }

    public function postulate(Request $request)
    {
        $validate = $this->repository->validatePostulation($request);

        if ($validate == "exist") {
            return back()->withErrors(['Ya te postulaste a este trabajo']);
        } else {
            return back()->with('succes', 'User succesfully updated');
        }
    }


    public function applicants($id)
    {
        $data_table = $this->repository->applicants();
        return view('jobs.applicants')
            ->with('title', "Empleos")
            ->with('subtitle', '')
            ->with('data', $data_table);
    }
}
