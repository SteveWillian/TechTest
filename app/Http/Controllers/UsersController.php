<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    protected $modelClass = User::class;
    protected $repositoryClass = UserRepository::class;

    public function show()
    {
        $data_table = $this->repository->table();

        return view('users.tables')
            ->with('title', "Users")
            ->with('subtitle', '')
            ->with('data', $data_table);
    }

    public function create()
    {
        return view('users.create')
            ->with('title', "Users")
            ->with('subtitle', "");
    }

    public function edit($id)
    {
        $data = $this->repository->find($id);

        return view('users.edit')
            ->with('title', "Users")
            ->with('subtitle', '')
            ->with('data', $data);
    }

    public function store(UserRequest $request)
    {
        $this->model::create([
            'name' => $request->get('name'),
            'password' =>  Hash::make($request->get('password')),
            'email' => $request->get('email'),
            'type' => $request->get('type'),
        ]);

        return back()->with('succes', 'User succesfully crated');
    }

    public function delete($id)
    {
        $this->model::find($id)->delete();
        return response()->json(['error' => null, 'code' => 1]);
    }
}
