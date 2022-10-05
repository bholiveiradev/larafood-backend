<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Profile;
use Illuminate\Http\Request;

class PlanProfileController extends Controller
{
    private $repositoryProfile, $repositoryPlan;

    public function __construct(Profile $profile, Plan $plan)
    {
        $this->repositoryProfile = $profile;
        $this->repositoryPlan    = $plan;
    }

    public function profiles($planUrl)
    {
        $plan = $this->repositoryPlan
                     ->with('profiles')
                     ->where('url', $planUrl)
                     ->firstOrFail();

        return view('admin.pages.plans.profiles.index', compact('plan'));
    }

    public function available($planUrl)
    {
        $plan = $this->repositoryPlan
                     ->with('profiles')
                     ->where('url', $planUrl)
                     ->firstOrFail();

        $profiles = $this->repositoryProfile->available($plan->id)->get();

        return view('admin.pages.plans.profiles.available', compact('plan', 'profiles'));
    }

    public function search(Request $request, $planUrl)
    {
        $plan = $this->repositoryPlan
                     ->with('profiles')
                     ->where('url', $planUrl)
                     ->firstOrFail();

        $profiles = $this->repositoryProfile
                         ->available($plan->id, $request->text)
                         ->get();

        return view('admin.pages.plans.profiles.available', compact('plan', 'profiles'));
    }

    public function attachProfilesToPlan(Request $request, $planUrl)
    {
        $plan = $this->repositoryPlan->where('url', $planUrl)->firstOrFail();

        $plan->profiles()->attach($request->profiles);

        return back();
    }

    public function detachProfilesToPlan($planUrl, $profileId)
    {
        $plan = $this->repositoryPlan->where('url', $planUrl)->firstOrFail();

        $plan->profiles()->detach($profileId);

        return back();
    }
}
