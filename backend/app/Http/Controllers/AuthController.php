<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mdl_user; // Certifique-se de que o modelo está no namespace correto
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // Método para exibir o formulário de login
    public function showLoginForm()
    {
        return view('auth.login'); // Altere o caminho da view se necessário
    }

    public function login(Request $request)
    {
        // Validar os dados de entrada
        $request->validate([
            'email' => 'required|email', // Alterado para validar o campo email
            'password' => 'required'
        ]);

        // Buscar o usuário no banco de dados do Moodle pelo email
        $user = mdl_user::where('email', $request->input('email'))->first(); // Alterado para buscar pelo email

        // Verificar se o usuário existe e se a senha está correta
        if ($user && $this->checkMoodlePassword($request->input('password'), $user->password)) {
            // O login foi bem-sucedido
            Session::put('user', $user); // Armazenando o usuário na sessão
            
            return redirect()->route('welcome'); // Redirecionar para a página de boas-vindasn
        } else {
            // Falha no login
            return back()->withErrors([
                'email' => 'As credenciais informadas estão incorretas.', // Alterado para email
            ]);
        }
    }

    // Método para verificar a senha do Moodle
    private function checkMoodlePassword($inputPassword, $hashedPassword)
    {
        // Usar a função password_verify para verificar o hash da senha
        return password_verify($inputPassword, $hashedPassword);
    }
}
