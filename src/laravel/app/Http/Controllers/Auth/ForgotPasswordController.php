<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.passwords.forgot-password');
    }

    public function sendResetCode(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'E-mail não encontrado.']);
        }

        $token = Str::random(6); // ou usa um número com rand(100000,999999)
        $expires = Carbon::now()->addMinutes(10);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => $expires]
        );

        // Aqui tu pode usar Mail::send() com um template
        Mail::raw("Seu código de redefinição é: $token", function ($message) use ($request) {
            $message->to($request->email)->subject('Código de redefinição de senha');
        });

        return redirect()->route('password.reset', ['token' => $token])->with('email', $request->email);
    }

    public function showResetForm($token)
    {
        return view('auth.passwords.reset', ['token' => $token]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $record = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$record) {
            return back()->withErrors(['token' => 'Código inválido ou expirado.']);
        }

        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password),
        ]);

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('auth-academic')->with('status', 'Senha redefinida com sucesso!');
    }
}
