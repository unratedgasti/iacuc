<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use PDF;

class ApprovedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       $prf=array();
        $prfmain=array();
        $prfpartner=array();
        $prf=DB::table('prf_protocol')
        ->leftjoin('users','users.id','prf_protocol.invest_id')
        ->join('vw_protocol_status','prf_protocol.protocol_id','vw_protocol_status.protocol_id')
        ->whereIn('vw_protocol_status.status', array('FINAL APPROVED'))
        ->get();        

         return view('approved.main',array('prf'=>$prf, 'prfmain'=>$prfmain));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

     public function review($id)
    {
        
      $prf_details=DB::table('prf_protocol')
      ->select('prf_protocol.*', 'users.*','units.*', 'users.name as inv_name')
      ->leftjoin('users','prf_protocol.invest_id','=','users.id')
      ->leftjoin('units','prf_protocol.institute_id','=','units.id')
      ->where('protocol_id',$id)->first();
      // dd($prf_details);

      $prf_animals=DB::table('prf_protocol_animals')->where('protocol_id',$id)->get();

      $prf_personnel=DB::table('prf_protocol_personnel')->where('protocol_id',$id)->get();

      $prf_qualifications=DB::table('prf_protocol_qualifications')->where('protocol_id',$id)->get();

      $prf_rs=DB::table('prf_protocol_rs')->where('protocol_id',$id)->get();

      $prf_status=DB::table('protocol_status')
      ->leftjoin('ref_status','protocol_status.status','=','ref_status.id')->where('protocol_id',$id)->orderByDesc('date_created')->get();

      $currentstatus=DB::table('vw_protocol_status')
      ->where('protocol_id',$id)
      ->first();

      $review_details=DB::table('unit_reviews')->where('protocol_id',$id)->first();

  return view('approved.edit',array('prf_details'=>$prf_details,'prf_animals'=>$prf_animals, 'prf_personnel'=>$prf_personnel, 'prf_qualifications'=>$prf_qualifications, 'prf_rs'=>$prf_rs, 'prf_status'=>$prf_status,'review_details'=>$review_details));
}
}
