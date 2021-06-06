<?php

namespace App\Http\Middleware;

use App\Models\UserModel;
use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class PermissionAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        App::setLocale(session()->get('language'));

        if($request->session()->has('userInfo'))  {
            $userInfo = $request->session()->get('userInfo');

//            $route_name=$request->route()->getName();
//            $user=new UserModel();
//            $ids=$user->getPermission($user->find(session('userInfo')['id']));
//            $user=DB::table('permission')
//                ->where('route_name',$route_name)
//                ->whereIn('id',$ids)
//                ->count();
            if ($userInfo)  return $next($request);
            return redirect()->route('notify/noPermission');
        }

        return redirect()->route('auth/login');
    }
}

// news/login