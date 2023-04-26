<?php

namespace App\Http\Controllers\Courrier;

use App\Http\Controllers\Controller;
use App\Models\Courrier\Depart;
use Illuminate\Http\Response;

class DepartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('show');
    }
    /**
     * Display the specified file .
     */
    public function show($id):Response
    {
        $arriver = Depart::where('numero', $id);
        return Response([
            'arriver' => $arriver->get(),
        ]);

    }
}
