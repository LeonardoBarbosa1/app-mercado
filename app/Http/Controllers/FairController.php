<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFairRequest;
use App\Http\Requests\UpdateFairRequest;
use App\Models\Fair;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FairController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $fairs = Fair::where('user_id', $user->id)
            ->orderBy('status', 'asc')
            ->orderBy('date_fair', 'desc')
            ->paginate(12);

        return view('fair.index', ['fairs' => $fairs]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFairRequest $request)
    {
        $user = Auth::user();

        $fair = Fair::create([
            'name' => $request->name,
            'date_fair' => $request->date_fair . ' ' . now()->toTimeString(),
            'status' => $request->status,
            'user_id' => $user->id,
        ]);

        if($fair->save()){
            return redirect()->route('fair.index')->with('success', 'Feira cadastrada com sucesso');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFairRequest $request, Fair $fair)
    {
        $model = $this->findModel($fair);

        if ($model) {
            $fair->update([
                'name' => $request->name,
                'date_fair' => $request->date_fair . ' ' . now()->toTimeString(),
                'status' => $request->status,
            ]);

            if($fair->save()){
                return redirect()->route('fair.index')->with('success', 'Feira atualizada com sucesso');
            }
        }else{
            return redirect()->route('fair.index')->with('error', 'Feira não encontrada.');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fair $fair)
    {
        $model = $this->findModel($fair);

        DB::beginTransaction();

        try {
            if ($model->delete()) {
                DB::commit();
                return redirect()->route('fair.index')->with('success', 'Feira excluída com sucesso');
            } else {
                DB::rollBack();
                return redirect()->route('fair.index')->with('error', 'Erro ao excluir');
            }
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->route('fair.index')->with('error', $e->getMessage());
        }
    }

    public function products($id)
    {
        $user = Auth::user();

        $model = Fair::where('user_id', $user->id)
            ->where('id', $id)
            ->first();

        $fair = $model;

        $products = Product::where('fair_id', $model->id)
            ->orderBy('status', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        session(['id' => $id]);

        $total = $products->sum(function ($product) {
            return $product->quantity * $product->price;
        });

        return view('fair.products', [
            'products' => $products,
            'fair' => $fair,
            'total' => $total,
        ]);
    }

    public function findModel($fair)
    {
        $user = Auth::user();

        $model = Fair::where('user_id', $user->id)
            ->where('id', $fair->id)
            ->first();

        if($model){
            return $model;
        }
    }
}
