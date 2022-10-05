<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    private $repository;

    public function __construct(Permission $permission)
    {
        $this->repository = $permission;
    }

    public function index()
    {
        $permissions = $this->repository->latest()->paginate();

        return view('admin.pages.permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('admin.pages.permissions.create');
    }

    public function store(PermissionRequest $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('admin.permissions.index');
    }

    public function show($id)
    {
        $permission = $this->repository->findOrFail($id);

        return view('admin.pages.permissions.show', compact('permission'));
    }

    public function edit($id)
    {
        $permission = $this->repository->findOrFail($id);

        return view('admin.pages.permissions.edit', compact('permission'));
    }

    public function update(PermissionRequest $request, $id)
    {
        $permission = $this->repository
                           ->findOrFail($id);

        $permission->update($request->all());

        return redirect()->route('admin.permissions.edit', $permission->id);
    }

    public function destroy($id)
    {
        $this->repository->findOrFail($id)->delete();

        return redirect()->route('admin.permissions.index');
    }

    public function search(Request $request)
    {
        $permissions = $this->repository->search($request->text)->paginate();

        return view('admin.pages.permissions.index', compact('permissions'));
    }
}
