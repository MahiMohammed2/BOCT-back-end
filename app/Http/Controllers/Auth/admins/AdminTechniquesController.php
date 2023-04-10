<?php

namespace App\Http\Controllers\Auth\admins;

use App\Http\Controllers\Controller;
use App\Models\Auth\admins\AdminTechniques;
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

class AdminTechniquesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('login');
    }
    public function login(Request $request): Response
    {
        $technique = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:6|max:8',
        ]);

        if (Auth::guard('technique')->attempt($technique)) {
            $technique = AdminTechniques::where('email', $request->email)->first();
            if ($technique && Hash::check($request->password, $technique->password)) {
                $device = $request->userAgent();
                $token = $technique->createToken($device)->plainTextToken;
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
        $technique = Auth::guard('sanctum')->user();
        if (null == $token) {
            $technique->currentAccessToken()->delete();
        }
        $personaleToken = PersonalAccessToken::findToken($token);
        if ($technique->id === $personaleToken->tokenable_id && get_class($technique) === $personaleToken->tokenable_type) {
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
        $technique = Auth::user();
        if ($request->hasFile("image_profile")) {
            $exist = Storage::disk('public')->exists("technique/image/{$technique->image_profile}");
            if ($exist) {
                Storage::disk('public')->delete("technique/image/{$technique->image_profile}");
                $img = $request->file("image_profile");// Uploadedfile;
                $imageName = Str::random() . '.' . $img->getClientOriginalName();

                $path = Storage::disk('public')->putFileAs('technique/image', $img, $imageName);
                $exis = $technique->update([
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
                $path = Storage::disk('public')->putFileAs('technique/image', $img, $imageName);
                $exis = $technique->update([
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
        $employe = Employe::where('type', 'Technique')->get();
        $arriver = Arriver::where('type', 'Technique')->get();
        $depart = Depart::where('type_de_class', 'technique')->get();
        return Response([
            'datas' => $datas,
            'employe' => $employe,
            'arriver' => $arriver,
            'depart' => $depart,
        ]);

    }
}
