<?php

namespace App\Repository;

use App\Models\Events;
use App\Models\Guests;
use App\Models\Jobs;
use App\Models\JobsDetail;
use App\Models\UserPostulations;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JobsRepository extends BaseRepository
{

    public const MODEL_CLASS = Jobs::class;

    public function table()
    {
        $data = $this->model->query()->leftJoin('user_postulations', 'user_postulations.jobs_id', 'jobs.id')
            ->groupBy('jobs.id')
            ->get(['jobs.*', DB::raw('COUNT(user_postulations.id) as count')])->toArray();

        return $data;
    }

    public function applicants()
    {
        return UserPostulations::query()->leftJoin('users', 'users.id', 'user_postulations.user_id')->get(['users.*'])->toArray();
    }

    public function find($id)
    {
        $data = $this->model->query()->where('id', $id)->first()->toArray();
        return $data;
    }

    public function detail($id)
    {
        $data = $this->model->query()->leftjoin('job_detail', 'job_detail.job_id', 'jobs.id')->where('jobs.id', $id)->first(['jobs.id as job_id', 'jobs.queue', 'jobs.payload', 'job_detail.*'])->toArray();
        return $data;
    }
    public function validatePostulation($request)
    {
        $exist_postulation = UserPostulations::query()->where('jobs_id', $request['id'])->where('user_id', Auth::user()->id)->first();

        if (!$exist_postulation) {
            $data = UserPostulations::create([
                'jobs_id' => $request['id'],
                'user_id' => Auth::user()->id,
            ]);
            return "sucess";
        } else {
            return "exist";
        }
    }

    public function create($data)
    {
        $response = $this->model::create([
            'queue' => $data['queue'],
            'payload' => $data['payload']
        ]);

        JobsDetail::create([
            'tareas' => $data['detail']['tareas'],
            'costo_hora' => $data['detail']['costo_hora'],
            'puesto' => $data['detail']['puesto'],
            'moneda' => $data['detail']['moneda'],
            'pais' => $data['detail']['pais'],
            'job_id' => $response['id']
        ]);

        return $response;
    }

    public function dataFilter($data)
    {
        $data = $this->model->query()->leftJoin('user_postulations', 'user_postulations.jobs_id', 'jobs.id')
            ->where('jobs.queue', 'like', '%' . $data . '%')
            ->groupBy('jobs.id')
            ->get(['jobs.*', DB::raw('COUNT(user_postulations.id) as count')])->toArray();

        foreach ($data as $k => $val) {
            $data[$k]['reserved_at'] = date("d/m/Y", strtotime($val['reserved_at']));
            $data[$k]['available_at'] = date("d/m/Y", strtotime($val['available_at']));
            $data[$k]['created_at'] = date("d/m/Y", strtotime($val['created_at']));
        }

        return $data;
    }
}
