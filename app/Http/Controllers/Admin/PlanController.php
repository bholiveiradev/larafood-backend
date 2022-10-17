<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlanRequest;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    private $repository;

    public function __construct(Plan $plan)
    {
        $this->repository = $plan;

        $this->middleware('can:plans');
    }

    public function index()
    {
        $plans= $this->repository->latest()->paginate();

        return view('admin.pages.plans.index', compact('plans'));
    }

    public function create()
    {
        return view('admin.pages.plans.create');
    }

    public function store(PlanRequest $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('admin.plans.index');
    }

    public function show($url)
    {
        $plan = $this->repository->where('url', $url)->firstOrFail();

        return view('admin.pages.plans.show', compact('plan'));
    }

    public function edit($url)
    {
        $plan = $this->repository->where('url', $url)->firstOrFail();

        return view('admin.pages.plans.edit', compact('plan'));
    }

    public function update(Request $request, $url)
    {
        $plan = $this->repository->where('url', $url)->firstOrFail();

        $plan->update($request->all());

        return redirect()->route('admin.plans.edit', $plan->url);
    }

    public function destroy($url)
    {
        $plan = $this->repository
                     ->with('details')
                     ->where('url', $url)
                     ->firstOrFail();

        if ($plan->details->count())
            return back()->with('error', 'Existem detalhes relacionados a este plano, portanto não foi possível removê-lo.');

        $plan->delete();

        return redirect()->route('admin.plans.index');
    }

    public function search(Request $request)
    {
        $plans = $this->repository->search($request->text)->paginate();

        return view('admin.pages.plans.index', compact('plans'));
    }
}
