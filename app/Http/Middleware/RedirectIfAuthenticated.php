<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
           /* if (Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::HOME);
            } */
            $sessaoatualemail = session('data.emailadm');
            $sessaoatualpassword = session('data.password');
            $sessaoatualemailresp = session('data.email_r');
            $sessaoatualemailaluno = session('data.email_a');

            if(Auth::guard($guard)->check() ){
                if($guard ==='cantina' && Auth::guard('cantina')->user()->emailadm === $sessaoatualemail){
                    return redirect()->route('cantina.logistica');
                    //echo('hey');
                }elseif($guard ==='responsavel' && Auth::guard('responsavel')->user()->email === $sessaoatualemailresp){
                    return redirect()->route('responsavel.painel');
                }elseif($guard ==='aluno' && Auth::guard('aluno')->user()->email === $sessaoatualemailaluno){
                    return redirect()->route('aluno.painel');
                }elseif(Auth::guard($guard)->check() && Auth::user()->role == 1){
                    return redirect()->route('admin.dashboard');
                }elseif(Auth::guard($guard)->check() && Auth::user()->role == 2){

                }else{
                  return redirect()->back();
                  //echo('opa');
                }
            }
          /*
                if ( Auth::guard($guard)->check() && Auth::user()->role == 1){
                    //return redirect()->route('admin.dashboard');
                    echo('ola');
                }elseif( Auth::guard($guard)->check() && Auth::user()->role == 2){
                    //return redirect()->route('user.dashboard');
                }
           
            */
            
            
            
        }

        return $next($request);
    }
}
