<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private $repository;

    public function __construct(Role $role)
    {
        $this->repository = $role;

        $this->middleware('can:roles');
    }

    public function index()
    {
        $roles = $this->repository->latest()->paginate();

        return view('admin.pages.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.pages.roles.create');
    }

    public function store(RoleRequest $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('admin.roles.index');
    }

    public function show($id)
    {
        $role = $this->repository->findOrFail($id);

        return view('admin.pages.roles.show', compact('role'));
    }

    public function edit($id)
    {
        $role = $this->repository->findOrFail($id);

        return view('admin.pages.roles.edit', compact('role'));
    }

    public function update(RoleRequest $request, $id)
    {
        $role = $this->repository->findOrFail($id);

        $role->update($request->all());

        return redirect()->route('admin.roles.edit', $role->id);
    }

    public function destroy($id)
    {
        $this->repository->findOrFail($id)->delete();

        return redirect()->route('admin.roles.index');
    }

    public function search(Request $request)
    {
        $roles = $this->repository->search($request->text)->paginate();

        return view('admin.pages.roles.index', compact('roles'));
    }
}
