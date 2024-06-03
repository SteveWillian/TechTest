<?php

namespace App\Http\Controllers;

use App\Models\BaseModel;
use App\Repositories\BaseRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $title = "";
    protected $sub_title = "";

    protected $model;
    protected $modelClass = BaseModel::class;
    protected $repositoryClass;
    protected $repository;

    public function __construct()
    {
        $this->model = app($this->modelClass);
        $this->repository = app($this->repositoryClass);
    }
}
