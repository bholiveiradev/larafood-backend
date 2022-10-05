<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $plans = Plan::with('details')
                     ->orderBy('price')
                     ->get();

        return view('site.pages.home.index', compact('plans'));
    }

    public function planRegister($url)
    {
        $plan = Plan::where('url', $url)->first();

        if (!$plan)
            return back();

        session()->put('plan', $plan);

        return redirect()->route('register');
    }
}
