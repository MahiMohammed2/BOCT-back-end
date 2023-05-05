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
        $this->middleware('auth:sanctum')->except('show');
    }
    /**
     * Display the specified file .
     */
    public function show($id):Response
    {
        $arriver = Arriver::find($id);
            return Response([
                'arriver' => $arriver->get(),
            ]);

    }
}
