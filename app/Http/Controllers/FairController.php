<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFairRequest;
use App\Http\Requests\UpdateFairRequest;
use App\Models\Fair;
use Illuminate\Support\Facades\Auth;

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
     * Show the form for creating a new resource.
     */
    public function create()
    {

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
     * Display the specified resource.
     */
    public function show(Fair $fair)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fair $fair)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFairRequest $request, Fair $fair)
    {
        $user = Auth::user();

        $model = Fair::where('user_id', $user->id)
            ->where('id', $fair->id)
            ->first();

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
        //
    }
}
