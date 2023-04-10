<?php

namespace App\Http\Controllers\Auth\admins;

use App\Http\Controllers\Controller;
use App\Models\Auth\admins\AdminAdministrative;
use App\Models\Auth\admins\AdminFinancieres;
use App\Models\Auth\employe\Employe;
use App\Models\Courrier\Arriver;
use App\Models\Courrier\Depart;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Sanctum\PersonalAccessToken;

class AdminFinancieresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('login');
    }
    public function login(Request $request): Response
    {
        $finenciere = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:6|max:8',
        ]);

        if (Auth::guard('finenciere')->attempt($finenciere)) {
            $finenciere = AdminFinancieres::where('email', $request->email)->first();
            if ($finenciere && Hash::check($request->password, $finenciere->password)) {
                $device = $request->userAgent();
                $token = $finenciere->createToken($device)->plainTextToken;
                return Response([
                    'token' => $token
                ]);
            } else {
                return Response([
                    'message' => 'Your data is incorect'
                ]);
            }
        }
        return Response([
            'message' => 'Your data is incorect'
        ]);


    }
    public function logout($token = null): Response
    {
        $finenciere = Auth::guard('sanctum')->user();
        if (null == $token) {
            $finenciere->currentAccessToken()->delete();
        }
        $personaleToken = PersonalAccessToken::findToken($token);
        if ($finenciere->id === $personaleToken->tokenable_id && get_class($finenciere) === $personaleToken->tokenable_type) {
            $personaleToken->delete();
        }
        return Response([
            'message' => 'logout successful',
        ]);
    }
    public function addImageProfile(Request $request): Response
    {
        $request->validate([
            'image_profile' => 'nullable',
            'image_url' => 'sometimes',
        ]);
        $finenciere = Auth::user();
        if ($request->hasFile("image_profile")) {
            $exist = Storage::disk('public')->exists("finenciere/image/{$finenciere->image_profile}");
            if ($exist) {
                Storage::disk('public')->delete("finenciere/image/{$finenciere->image_profile}");
                $img = $request->file("image_profile");// Uploadedfile;
                $imageName = Str::random() . '.' . $img->getClientOriginalName();

                $path = Storage::disk('public')->putFileAs('finenciere/image', $img, $imageName);
                $exis = $finenciere->update([
                    'image_profile' => $imageName,
                    'image_url' => asset("storage/" . $path)
                ]);
                if ($exis) {
                    return Response([
                        'message' => 'image add successfully'
                    ]);
                }
            }
            else{
                $img = $request->file("image_profile");// Uploadedfile;
                $imageName = Str::random() . '.' . $img->getClientOriginalName();
                $path = Storage::disk('public')->putFileAs('finenciere/image', $img, $imageName);
                $exis = $finenciere->update([
                    'image_profile' => $imageName,
                    'image_url' => asset("storage/" . $path)
                ]);
                if ($exis) {
                    return Response([
                        'message' => 'image add successfully'
                    ]);
                }
            }

        }
        return Response([
            'message'=>'not good'
        ]);
    }

    public function index(): Response
    {
        $datas = Auth::user();
        $employe = Employe::where('type', 'Finenciere')->get();
        $arriver = Arriver::where('type', 'Finenciere')->get();
        $depart = Depart::where('type_de_class', 'finenciere')->get();
        return Response([
            'datas' => $datas,
            'employe' => $employe,
            'arriver' => $arriver,
            'depart' => $depart,
        ]);

    }
}
