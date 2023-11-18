<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
  public function auth(Request $request)
  {

    $user = User::where('email',$request->email)->first();
    Hash::check($request->password,$user->password);

    if(!$user || !Hash::check($request->password,$user->password)){
      throw ValidationException::withMessages([
            'email'=>['As credenciais comprovadas estão incorretas']
          ]);
    }

    $user->tokens()->delete();

    $token = $user->createToken($request->device_name)->plainTextToken;

    return response()->json([
      'token'=>$token,
    ]);
 
  }
}
