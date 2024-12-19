<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validar a entrada para o username
        $request->validate([
            'username' => 'required|string',
            'password'  => 'required|string'
        ]);
            
        // Enviar a requisição ao endpoint do Moodle para consultar o usuário
        $response = Http::get(env('MOODLE_URL') . "/webservice/rest/server.php", [
            'wstoken' => env('MOODLE_TOKEN'),  // Usar o token fixo
            'wsfunction' => 'core_user_get_users_by_field',  // Função para buscar usuários
            'moodlewsrestformat' => env('MOODLE_FORMAT'),
            'field' => 'username',
            'values[0]' => $request->username,
        ]);
        
        // Verificar se a resposta foi bem-sucedida
        if ($response->successful()) {
            $userData = $response->json();
            if (isset($userData[0])) {
                $user = null;
                $userExists = User::where('email', $userData[0]['email'])->first();
                if (!$userExists) {
                    $user = User::create([
                        'name'  => $userData[0]['username'],
                        'email' => $userData[0]['email'],
                        'password'  => bcrypt($request->password)
                    ]);
                } else {
                    $user = $userExists;
                }

                $authToken = $user->createToken('auth-token')->plainTextToken;
                if (Auth::attempt(['name'   => $request->username, 'password' => $request->password])) {
                    // Se o usuário for encontrado, redireciona para o menu com sucesso
                    return redirect()->route('menu')->with([
                        'status' => 'success',
                        'user' => $user,
                        'token' => $authToken
                    ]);
                }
                // return response()->json([
                //     'access_token'  => $authToken
                // ]);
            }

            // Caso o usuário não seja encontrado
            return response()->json([
                'status' => 'error',
                'message' => 'User not found on Moodle',
            ], 404);
        }
        // }
        // Caso falha ao buscar os dados do usuário
        return response()->json([
            'status' => 'error',
            'message' => 'Failed to fetch user data from Moodle',
        ], 500);
    }
    
    public function logout() {
        auth()->logout();

        return redirect()->route('login');
    }
}
