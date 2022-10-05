<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlanDetailRequest;
use App\Models\Plan;

class PlanDetailController extends Controller
{
    private $repository;

    public function __construct(Plan $plan)
    {
        $this->repository = $plan;
    }

    public function index($planUrl)
    {
        $plan = $this->repository
                     ->with('details')
                     ->where('url', $planUrl)
                     ->firstOrFail();

        return view('admin.pages.plans.details.index', compact('plan'));
    }

    public function create($planUrl)
    {
        $plan = $this->repository->where('url', $planUrl)->firstOrFail();

        return view('admin.pages.plans.details.create', compact('plan'));
    }

    public function store(PlanDetailRequest $request, $planUrl)
    {
        $plan = $this->repository->where('url', $planUrl)->firstOrFail();

        $plan->details()->create($request->all());

        return redirect()->route('admin.plans.details.index', $plan->url);
    }

    public function edit($planUrl, $detailId)
    {
        $plan = $this->repository
                     ->where('url', $planUrl)
                     ->with(['details' => function ($query) use ($detailId) {
                        $query->where('id', $detailId);
                     }])
                     ->firstOrFail();

        return view('admin.pages.plans.details.edit', compact('plan'));
    }

    public function update(PlanDetailRequest $request, $planUrl, $detailId)
    {
        $plan = $this->repository
                     ->where('url', $planUrl)
                     ->firstOrFail();

        $plan->details()
             ->findOrFail($detailId)
             ->update($request->all());

        return back();
    }

    public function destroy($planUrl, $detailId)
    {
        $plan = $this->repository
                     ->where('url', $planUrl)
                     ->firstOrFail();

        $plan->details()
             ->findOrFail($detailId)
             ->delete();

        return redirect()->route('admin.plans.details.index');
    }
}
