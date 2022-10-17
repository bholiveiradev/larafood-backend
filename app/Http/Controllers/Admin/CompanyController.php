<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    private $companyRepository;
    private $planRepository;

    public function __construct(Company $company, Plan $plan)
    {
        $this->companyRepository = $company;
        $this->planRepository = $plan;

        $this->middleware('can:companies');
    }

    public function index()
    {
        $companies = $this->companyRepository->latest()->paginate();

        return view('admin.pages.companies.index', compact('companies'));
    }

    public function show($uuid)
    {
        $company = $this->companyRepository->with('plan')->where('uuid', $uuid)->firstOrFail();

        return view('admin.pages.companies.show', compact('company'));
    }

    public function edit($uuid)
    {
        $company = $this->companyRepository->where('uuid', $uuid)->firstOrFail();
        $plans   = $this->planRepository->all();

        return view('admin.pages.companies.edit', compact('company', 'plans'));
    }

    public function update(CompanyRequest $request, $uuid)
    {
        $company = $this->companyRepository->where('uuid', $uuid)->firstOrFail();

        $dataRequest = $request->all();

        if ($request->hasFile('logo') && $request->logo->isValid()) {

            if (Storage::exists($company->logo))
                Storage::delete($company->logo);

            $dataRequest['logo']  = $request->logo->store("companies/{$company->uuid}/logo");
        }

        $company->update($dataRequest);

        return redirect()->route('admin.companies.edit', $company->uuid);
    }

    public function destroy($uuid)
    {
        $company = $this->companyRepository->where('uuid', $uuid)->firstOrFail();

        if (Storage::exists($company->logo))
            Storage::delete($company->logo);

        $company->delete();

        return redirect()->route('admin.companies.index');
    }

    public function search(Request $request)
    {
        $companies = $this->companyRepository->search($request->text)->paginate();

        return view('admin.pages.companies.index', compact('companies'));
    }
}
