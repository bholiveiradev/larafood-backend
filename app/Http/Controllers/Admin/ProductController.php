<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private $repository;

    public function __construct(Product $product)
    {
        $this->repository = $product;

        $this->middleware('can:products');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->repository->latest()->paginate();

        return view('admin.pages.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $dataRequest = $request->all();

        $company = auth()->user()->company;

        if ($request->hasFile('image') && $request->image->isValid())
            $dataRequest['image']  = $request->image->store("companies/{$company->uuid}/products");

        $this->repository->create($dataRequest);

        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->repository->findOrFail($id);

        return view('admin.pages.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->repository->findOrFail($id);

        return view('admin.pages.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = $this->repository->findOrFail($id);

        $dataRequest = $request->all();

        $company = auth()->user()->company;

        if ($request->hasFile('image') && $request->image->isValid()) {

            if (Storage::exists($product->image))
                Storage::delete($product->image);

            $dataRequest['image']  = $request->image->store("companies/{$company->uuid}/products");
        }

        $product->update($dataRequest);

        return redirect()->route('admin.products.edit', $product->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->repository->findOrFail($id);

        if (Storage::exists($product->image))
            Storage::delete($product->image);

        $product->delete();

        return redirect()->route('admin.products.index');
    }

    public function search(Request $request)
    {
        $products = $this->repository->search($request->text)->paginate();

        return view('admin.pages.products.index', compact('products'));
    }
}
