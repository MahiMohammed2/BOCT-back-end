<?php

namespace App\Http\Controllers\Courrier;

use App\Http\Controllers\Controller;
use App\Models\Courrier\Arriver;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class ArriverController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('login');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id):Response
    {
        $arriver = Arriver::where('numero', $id)->get();
        if(count($arriver)){
            return Response([
                'arriver' => $arriver,
            ]);
        }else{
            return Response([
                'error' => 'Arriver not found',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
