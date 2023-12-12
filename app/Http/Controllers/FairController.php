<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFairRequest;
use App\Http\Requests\UpdateFairRequest;
use App\Models\Fair;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
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

    public function productSearch(Request $request, $id){

        $user = Auth::user();

        $searchTerm = $request->input('product_search');

        $model = Fair::where('user_id', $user->id)
            ->where('id', $id)
            ->first();

        $fair = $model;

        $products = Product::where('fair_id', $id)
            ->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('price', 'like', '%' . $searchTerm . '%')
                    ->orWhere('status', 'like', '%' . $searchTerm . '%')
                    ->orWhere('brand', 'like', '%' . $searchTerm . '%')
                    ->orWhere('quantity', 'like', '%' . $searchTerm . '%');
            })
            ->orderByDesc('created_at')
            ->get();

        $product = Product::where('fair_id', $model->id)
            ->orderBy('status', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        $total = $product->sum(function ($product) {
            return $product->quantity * $product->price;
        });

        return view('fair.products', [
            'products' => $products,
            'fair' => $fair,
            'total' => $total,
        ]);
    }

    public function historic()
    {
        $user = Auth::user();

        $fairs = Fair::where('user_id', $user->id)
            ->orderBy('status', 'asc')
            ->orderBy('date_fair', 'desc')
            ->paginate(12);

        $fairTotals = [];

        foreach ($fairs as $fair) {
            $fairProducts = Product::where('fair_id', $fair->id)
                ->orderBy('status', 'asc')
                ->orderBy('created_at', 'desc')
                ->get();

            $total = $fairProducts->sum(function ($product) {
                return $product->quantity * $product->price;
            });

            $fairTotals[$fair->id] = $total;

        }

        return view('fair.historic', [
            'fairs' => $fairs,
            'fairTotals' => $fairTotals,
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
