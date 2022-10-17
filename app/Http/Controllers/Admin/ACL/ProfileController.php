<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private $repository;

    public function __construct(Profile $profile)
    {
        $this->repository = $profile;

        $this->middleware('can:profiles');
    }

    public function index()
    {
        $profiles = $this->repository->latest()->paginate();

        return view('admin.pages.profiles.index', compact('profiles'));
    }

    public function create()
    {
        return view('admin.pages.profiles.create');
    }

    public function store(ProfileRequest $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('admin.profiles.index');
    }

    public function show($id)
    {
        $profile = $this->repository->findOrFail($id);

        return view('admin.pages.profiles.show', compact('profile'));
    }

    public function edit($id)
    {
        $profile = $this->repository->findOrFail($id);

        return view('admin.pages.profiles.edit', compact('profile'));
    }

    public function update(ProfileRequest $request, $id)
    {
        $profile = $this->repository->findOrFail($id);

        $profile->update($request->all());

        return redirect()->route('admin.profiles.edit', $profile->id);
    }

    public function destroy($id)
    {
        $this->repository->findOrFail($id)->delete();

        return redirect()->route('admin.profiles.index');
    }

    public function search(Request $request)
    {
        $profiles = $this->repository->search($request->text)->paginate();

        return view('admin.pages.profiles.index', compact('profiles'));
    }
}
