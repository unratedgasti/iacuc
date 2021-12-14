<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
 
    public function index()
    {
     if(isadmin())
     {
       $prf=DB::table('prf_protocol')
       ->leftjoin('users','users.id','prf_protocol.invest_id')
       ->join('vw_protocol_status','prf_protocol.protocol_id','vw_protocol_status.protocol_id')
       ->get();
     }
     elseif(isinvestigator() and isunitrep())
     {
       $unit=DB::table('user_roles')->select('unit_id')->where('user_id',Auth::user()->id)->where('role_id',3)->first();
       $prf=DB::table('prf_protocol')
       ->leftjoin('users','users.id','prf_protocol.invest_id')
       ->join('vw_protocol_status','prf_protocol.protocol_id','vw_protocol_status.protocol_id')
       ->where('prf_protocol.invest_id',Auth::user()->id)
       ->get();
     }
     elseif(isinvestigator())
     {
       $prf=DB::table('prf_protocol')
       ->leftjoin('users','users.id','prf_protocol.invest_id')
       ->join('vw_protocol_status','prf_protocol.protocol_id','vw_protocol_status.protocol_id')
       ->where('prf_protocol.invest_id',Auth::user()->id)
       ->get();
     }

     return view('prf.main',array('prf'=>$prf));
   }
}
