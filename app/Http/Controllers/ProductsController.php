<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductsRequest;
use App\Http\Requests\UpdateProductsRequest;
use App\Models\Fair;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductsRequest $request)
    {
        $user = Auth::user();

        $fairId = $request->fair_id;

        $fair = Product::create([
            'name' => $request->name,
            'status' => $request->status,
            'brand' => $request->brand,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'fair_id' => $fairId,
        ]);

        if($fair->save()){
            return redirect()->route('products', ['id' => $fairId])->with('success', 'Produto cadastrado com sucesso');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductsRequest $request, Product $product)
    {
        $model = $this->findModel($product);

        $fairId = $model->fair_id;

        if ($model) {
            $product->update([
                'name' => $request->name,
                'status' => $request->status,
                'brand' => $request->brand,
                'quantity' => $request->quantity,
                'price' => $request->price,
            ]);

            if($product->save()){
                return redirect()->route('products', ['id' => $fairId])->with('success', 'Produto atualizado com sucesso');
            }
        }else{
            return redirect()->route('products', ['id' => $fairId])->with('error', 'Produto não encontrado.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $model = $this->findModel($product);

        $fairId = $model->fair_id;

        DB::beginTransaction();

        try {
            if ($model->delete()) {
                DB::commit();
                return redirect()->route('products', ['id' => $fairId])->with('success', 'Produto excluído com sucesso');
            } else {
                DB::rollBack();
                return redirect()->route('products', ['id' => $fairId])->with('error', 'Erro ao excluir');
            }
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->route('products', ['id' => $fairId])->with('error', $e->getMessage());
        }
    }

    public function findModel($product)
    {
        $user = Auth::user();

        $model = Product::where('fair_id', $product->fair_id)->first();

        if($model){
            return $model;
        }
    }
}
