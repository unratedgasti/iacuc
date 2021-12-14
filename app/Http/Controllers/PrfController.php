<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Mail;

class PrfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
     if(isadmin())
     {
       $prf=DB::table('prf_protocol')
       ->leftjoin('users','users.id','prf_protocol.invest_id')
       ->join('vw_protocol_status','prf_protocol.protocol_id','vw_protocol_status.protocol_id')
       ->whereNotIn('vw_protocol_status.status', array('FINAL APPROVED','RESUBMIT'))
       ->get();
     }
     elseif(isinvestigator() and isunitrep())
     {
       $unit=DB::table('user_roles')->select('unit_id')->where('user_id',Auth::user()->id)->where('role_id',3)->first();
       $prf=DB::table('prf_protocol')
       ->leftjoin('users','users.id','prf_protocol.invest_id')
       ->join('vw_protocol_status','prf_protocol.protocol_id','vw_protocol_status.protocol_id')
       ->where('prf_protocol.invest_id',Auth::user()->id)
       ->whereNotIn('vw_protocol_status.status', array('FINAL APPROVED','RESUBMIT'))
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
  
    public function create()
    {
      $units=DB::table('units')->get();
      return view('prf.create', ['units' => $units]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $action = $request->submit;
      $tosave=$request->all();
     //  $current_year=date('Y');
     //  $control=DB::table('prf_series')->where('type','PRF')->first();
     //  if($control->year==$current_year)
     //  {
     //    $current_counter=$control->current_counter+1;
     //    $counter_digits=str_pad($current_counter, $control->counter_length, '0', STR_PAD_LEFT);
     //    $current_last='PRF-'.$control->year.'-'.$counter_digits;
     //    DB::table('prf_series')
     //    ->where('type', 'PRF')
     //    ->update(['current_last' => $current_last,'current_counter' => $current_counter]);


     //  }
     //  else
     //  {
     //    $year=$current_year;
     //    $current_counter=0+1;
     //    $counter_digits=str_pad($current_counter, $control->counter_length, '0', STR_PAD_LEFT);
     //    $current_last='PRF-'.$control->year.'-'.$counter_digits;
     //    DB::table('prf_series')
     //    ->where('type', 'PRF')
     //    ->update(['year'=>$year,'current_last' =>  $current_last,'current_counter' => $current_counter]);


     //  }

     //  if($tosave['purpose']=='RESEARCH')
     //  {
     //    $protocol_no= $current_last.'-R';
     //  }
     //  else
     //  {
     //   $protocol_no= $current_last.'-T';
     // }

     // $tosave['protocol_no']=$protocol_no;

     unset($tosave['submit']);
      unset($tosave['_token']);
      unset($tosave['rstudy']);
      unset($tosave['qual']);

      unset($tosave['investigator_name']);
      unset($tosave['email']);
      unset($tosave['contact_number']);

      unset($tosave['species']);
      unset($tosave['strain']);
      unset($tosave['source']);
      unset($tosave['age']);
      unset($tosave['weight']);
      unset($tosave['sex']);
      unset($tosave['number']);

      unset($tosave['name']);
      unset($tosave['title']);
      unset($tosave['roles']);
      unset($tosave['qualification']);
      unset($tosave['training_vacc']);
      if($tosave['prev_protocol_no']<>""||$tosave['prev_protocol_no']<>NUll)
      {
        $tosave['prev_protocol']=1;
      }
      else
      {
        $tosave['prev_protocol']=0;
      }

      if(!$tosave['date_from']){
        $tosave['date_from'] = date('Y-m-d');
      }
      if(!$tosave['date_to']){
        $tosave['date_to'] = date("Y-m-d", time() + 86400);
      }


      if($tosave['date_from']<>"" ||$tosave['date_from']<>NULL)
      {
        $var=$tosave['date_from'];
        unset($tosave['date_from']);
        $date_from=date('Y-m-d', strtotime($var));
        $tosave['date_from']=$date_from;
      }

      if($tosave['date_to']<>"" ||$tosave['date_to']<>NULL)
      {
        $var=$tosave['date_to'];
        unset($tosave['date_to']);
        $date_to=date('Y-m-d', strtotime($var));
        $tosave['date_to']=$date_to;
      }
      $id=DB::table('prf_protocol')->insertGetId($tosave);


      foreach ($request['rstudy'] as $value) {
        if($value){
          DB::table('prf_protocol_rs')->insert([
            'protocol_id'=>$id,
            'research_study'=>$value
          ]);
        }

      }
  
      foreach ($request['qual'] as $value) {
       if($value){
        DB::table('prf_protocol_qualifications')->insert([
          'protocol_id'=>$id,
          'qualification_desc'=>$value
        ]);
      }
    }


    $animalscount=count($request['species']);

    for($i=0; $i<$animalscount; $i++)
    {
      if($request['species'][$i]==null && $request['strain'][$i] ==null && $request['source'][$i]==null && $request['age'][$i]==null && $request['weight'][$i]==null && $request['sex'][$i]==null && $request['number'][$i]==null)
      {
        $save=false;
      }
      else
      {
        $save=true;
      }

      if($save)
      {
        DB::table('prf_protocol_animals')->insert([
          'protocol_id'=>$id,
          'species'=>$request['species'][$i],
          'strain'=>$request['strain'][$i],
          'source'=>$request['source'][$i],
          'age'=>$request['age'][$i],
          'weight'=>$request['weight'][$i],
          'sex'=>$request['sex'][$i],
          'number'=>$request['number'][$i]
        ]);
      }
    }

    $percount=count($request['name']);

    for($i=0; $i<$percount; $i++)
    {

      if($request['name'][$i]==null && $request['title'][$i]==null && $request['roles'][$i] ==null && $request['qualification'][$i]==null && $request['training_vacc'][$i]==null)
      {
        $save=false;
      }
      else
      {
        $save=true;
      }

      if($save)
      {
        DB::table('prf_protocol_personnel')->insert([
          'protocol_id'=>$id,
          'name'=>$request['name'][$i],
          'title'=>$request['title'][$i],
          'roles'=>$request['roles'][$i],
          'qualification'=>$request['qualification'][$i],
          'training_vacc'=>$request['training_vacc'][$i]
        ]);
      }
    }

    DB::table('protocol_status')->insert([
      'protocol_id'=>$id,
      'status'=>1,
      'created_by'=>Auth::user()->id

    ]);
  
    $prf_details= DB::table('prf_protocol')
    ->select('prf_protocol.*', 'users.*','units.*','units.id as unit_id', 'users.name as inv_name')           
    ->leftjoin('users','prf_protocol.invest_id','=','users.id')
    ->leftjoin('units','prf_protocol.institute_id','=','units.id')
    ->where('prf_protocol.protocol_id',$id)->first();
    if($action == "SUBMIT"){
      $prf=DB::table('prf_protocol')
      ->leftjoin('users','users.id','prf_protocol.invest_id')
      ->join('vw_protocol_status','prf_protocol.protocol_id','vw_protocol_status.protocol_id')
      ->where('prf_protocol.protocol_id', $id)
      ->first();
      if($prf->status == "MINOR REVISIONS"){    
        DB::table('protocol_status')->insert([
          'protocol_id'=>$request->protocol_id,
          'status'=>6,
          'created_by'=>Auth::user()->id
        ]);
        $prf_details= DB::table('prf_protocol')
           ->select('prf_protocol.*', 'users.*','units.*','units.id as unit_id', 'users.name as inv_name')           
           ->leftjoin('users','prf_protocol.invest_id','=','users.id')
           ->leftjoin('units','prf_protocol.institute_id','=','units.id')
           ->where('prf_protocol.protocol_id',$id)->first();
           
            $secretary=DB::table('users')
            ->select('users.*')
            ->leftjoin('user_roles', 'users.id', 'user_roles.user_id')
            ->where('user_roles.role_id', 4)
            ->first();
           $this->mailMinorToSec($prf_details, $secretary);
      }elseif($prf->status == "REJECTED"){    
        DB::table('protocol_status')->insert([
          'protocol_id'=>$request->protocol_id,
          'status'=>6,
          'created_by'=>Auth::user()->id
        ]);

        $prf_details= DB::table('prf_protocol')
        ->select('prf_protocol.*', 'users.*','units.*','units.id as unit_id', 'users.name as inv_name')           
        ->leftjoin('users','prf_protocol.invest_id','=','users.id')
        ->leftjoin('units','prf_protocol.institute_id','=','units.id')
        ->where('prf_protocol.protocol_id',$id)->first();
        
         $secretary=DB::table('users')
         ->select('users.*')
         ->leftjoin('user_roles', 'users.id', 'user_roles.user_id')
         ->where('user_roles.role_id', 4)
         ->first();
        $this->mailRejectedToSec($prf_details, $secretary);
      }elseif($prf->status == "FOR APPROVAL SECRETARY"){
        DB::table('protocol_status')->insert([
          'protocol_id'=>$id,
          'status'=>6,
          'created_by'=>Auth::user()->id
        ]);
      }else{  
          if($prf->status == "CREATED"){
            $prf_details= DB::table('prf_protocol')
           ->select('prf_protocol.*', 'users.*','units.*','units.id as unit_id', 'users.name as inv_name')           
           ->leftjoin('users','prf_protocol.invest_id','=','users.id')
           ->leftjoin('units','prf_protocol.institute_id','=','units.id')
           ->where('prf_protocol.protocol_id',$id)->first();
           
            $units=DB::table('units')
            ->select('users.*')
            ->leftjoin('user_roles', 'units.id', 'user_roles.role_id')
            ->leftjoin('users', 'user_roles.user_id', 'users.id')
            ->where('user_roles.unit_id', $prf_details->unit_id)
            ->orderBy('user_roles.id', 'desc')
            ->first();
            $this->mailNewPRF($prf_details, $units);
          }

          if($prf->status == "RETURNED FROM UNIT"){
            $prf_details= DB::table('prf_protocol')
           ->select('prf_protocol.*', 'users.*','units.*','units.id as unit_id', 'users.name as inv_name')           
           ->leftjoin('users','prf_protocol.invest_id','=','users.id')
           ->leftjoin('units','prf_protocol.institute_id','=','units.id')
           ->where('prf_protocol.protocol_id',$id)->first();
           
            $units=DB::table('units')
            ->select('users.*')
            ->leftjoin('user_roles', 'units.id', 'user_roles.role_id')
            ->leftjoin('users', 'user_roles.user_id', 'users.id')
            ->where('user_roles.unit_id', $id)
            ->orderBy('user_roles.id', 'desc')
            ->first();
            $this->mailResubmitPRF($prf_details, $units);
          }

        DB::table('protocol_status')->insert([
          'protocol_id'=>$id,
          'status'=>2,
          'created_by'=>Auth::user()->id
        ]);
      }
    }



    return redirect('/prf?response=1');


  }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
       $prf_details=DB::table('prf_protocol')
      ->select('prf_protocol.*', 'users.*','units.*', 'users.name as inv_name','vw_protocol_status.*')
      ->leftjoin('users','prf_protocol.invest_id','=','users.id')
      ->leftjoin('units','prf_protocol.institute_id','=','units.id')
      ->join('vw_protocol_status','prf_protocol.protocol_id','vw_protocol_status.protocol_id')
      ->where('prf_protocol.protocol_id',$id)->first();

      $prf_animals=DB::table('prf_protocol_animals')->where('protocol_id',$id)->get();

      $prf_personnel=DB::table('prf_protocol_personnel')->where('protocol_id',$id)->get();

      $prf_qualifications=DB::table('prf_protocol_qualifications')->where('protocol_id',$id)->get();

      $prf_rs=DB::table('prf_protocol_rs')->where('protocol_id',$id)->get();

      $prf_status=DB::table('protocol_status')
      ->leftjoin('ref_status','protocol_status.status','=','ref_status.id')->where('protocol_id',$id)->orderByDesc('date_created')->get();

      $units=DB::table('units')->get();
      $unit_reviews =  DB::table('unit_reviews')->where('protocol_id', $id)->get();
      return view('prf.view',array('prf_details'=>$prf_details,'prf_animals'=>$prf_animals, 'prf_personnel'=>$prf_personnel, 'prf_qualifications'=>$prf_qualifications, 'prf_rs'=>$prf_rs, 'prf_status'=>$prf_status, 'units'=>$units, 'unit_reviews' => $unit_reviews));

    /*  $prf_details=DB::table('prf_protocol')
      ->select('prf_protocol.*', 'users.*','units.*', 'users.name as inv_name')
      ->leftjoin('users','prf_protocol.invest_id','=','users.id')
      ->leftjoin('units','prf_protocol.institute_id','=','units.id')
      ->where('protocol_id',$id)->first();

      $prf_animals=DB::table('prf_protocol_animals')->where('protocol_id',$id)->get();

      $prf_personnel=DB::table('prf_protocol_personnel')->where('protocol_id',$id)->get();

      $prf_qualifications=DB::table('prf_protocol_qualifications')->where('protocol_id',$id)->get();

      $prf_rs=DB::table('prf_protocol_rs')->where('protocol_id',$id)->get();

      $prf_status=DB::table('protocol_status')
      ->leftjoin('ref_status','protocol_status.status','=','ref_status.id')->where('protocol_id',$id)->orderByDesc('date_created')->get();


      return view('prf.view',array('prf_details'=>$prf_details,'prf_animals'=>$prf_animals, 'prf_personnel'=>$prf_personnel, 'prf_qualifications'=>$prf_qualifications, 'prf_rs'=>$prf_rs, 'prf_status'=>$prf_status));*/

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $prf_details=DB::table('prf_protocol')
      ->select('prf_protocol.*', 'users.*','units.*', 'users.name as inv_name')
      ->leftjoin('users','prf_protocol.invest_id','=','users.id')
      ->leftjoin('units','prf_protocol.institute_id','=','units.id')
      ->where('protocol_id',$id)->first();

      $prf_animals=DB::table('prf_protocol_animals')->where('protocol_id',$id)->get();

      $prf_personnel=DB::table('prf_protocol_personnel')->where('protocol_id',$id)->get();

      $prf_qualifications=DB::table('prf_protocol_qualifications')->where('protocol_id',$id)->get();

      $prf_rs=DB::table('prf_protocol_rs')->where('protocol_id',$id)->get();

      $prf_status=DB::table('protocol_status')
      ->leftjoin('ref_status','protocol_status.status','=','ref_status.id')->where('protocol_id',$id)->orderByDesc('date_created')->get();

      $units=DB::table('units')->get();


      return view('prf.edit',array('prf_details'=>$prf_details,'prf_animals'=>$prf_animals, 'prf_personnel'=>$prf_personnel, 'prf_qualifications'=>$prf_qualifications, 'prf_rs'=>$prf_rs, 'prf_status'=>$prf_status, 'units'=>$units));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
      $checkSubmit = $request->checkSubmit;
      $protocol_id=$id;
      $tosave=$request->all();

      unset($tosave['checkSubmit']);
      unset($tosave['_token']);
      unset($tosave['rstudy']);
      unset($tosave['qual']);

      unset($tosave['investigator_name']);
      unset($tosave['email']);
      unset($tosave['contact_number']);

      unset($tosave['species']);
      unset($tosave['strain']);
      unset($tosave['source']);
      unset($tosave['age']);
      unset($tosave['weight']);
      unset($tosave['sex']);
      unset($tosave['number']);

      unset($tosave['name']);
      unset($tosave['title']);
      unset($tosave['roles']);
      unset($tosave['qualification']);
      unset($tosave['training_vacc']);
      if($tosave['prev_protocol_no']<>""||$tosave['prev_protocol_no']<>NUll)
      {
        $tosave['prev_protocol']=1;
      }
      else
      {
        $tosave['prev_protocol']=0;
      }
      if($tosave['date_from']<>"" ||$tosave['date_from']<>NULL)
      {
        $var=$tosave['date_from'];
        unset($tosave['date_from']);
        $date_from=date('Y-m-d', strtotime($var));
        $tosave['date_from']=$date_from;
      }

      if($tosave['date_to']<>"" ||$tosave['date_to']<>NULL)
      {
        $var=$tosave['date_to'];
        unset($tosave['date_to']);
        $date_to=date('Y-m-d', strtotime($var));
        $tosave['date_to']=$date_to;
      }


      DB::table('prf_protocol')
      ->where('protocol_id', $protocol_id)
      ->update($tosave);

      DB::table('prf_protocol_rs')->where('protocol_id', '=', $protocol_id)->delete();     
      
       
      foreach ($request['rstudy'] as $value) {
        if($value){
          DB::table('prf_protocol_rs')->insert([
            'protocol_id'=>$protocol_id,
            'research_study'=>$value
          ]);
        }

      }
     
      DB::table('prf_protocol_qualifications')->where('protocol_id', '=', $protocol_id)->delete();    
     if($request['qual'] != null){
       foreach ($request['qual'] as $value) {
       if($value){
        DB::table('prf_protocol_qualifications')->insert([
          'protocol_id'=>$protocol_id,
          'qualification_desc'=>$value
        ]);
      }
    }
     }


    $animalscount=count($request['species']);
    DB::table('prf_protocol_animals')->where('protocol_id', '=', $protocol_id)->delete(); 
    for($i=0; $i<$animalscount; $i++)
    {
      if($request['species'][$i]==null && $request['strain'][$i] ==null && $request['source'][$i]==null && $request['age'][$i]==null && $request['weight'][$i]==null && $request['sex'][$i]==null && $request['number'][$i]==null)
      {
        $save=false;
      }
      else
      {
        $save=true;
      }

      if($save)
      {

        DB::table('prf_protocol_animals')->insert([
          'protocol_id'=>$protocol_id,
          'species'=>$request['species'][$i],
          'strain'=>$request['strain'][$i],
          'source'=>$request['source'][$i],
          'age'=>$request['age'][$i],
          'weight'=>$request['weight'][$i],
          'sex'=>$request['sex'][$i],
          'number'=>$request['number'][$i]
        ]);
      }
    }

    $percount=count($request['name']);
    DB::table('prf_protocol_personnel')->where('protocol_id', '=', $protocol_id)->delete();
    for($i=0; $i<$percount; $i++)
    {

      if($request['name'][$i]==null && $request['title'][$i]==null && $request['roles'][$i] ==null && $request['qualification'][$i]==null && $request['training_vacc'][$i]==null)
      {
        $save=false;
      }
      else
      {
        $save=true;
      }
      if($save)
      {
     
        DB::table('prf_protocol_personnel')->insert([
          'protocol_id'=>$protocol_id,
          'name'=>$request['name'][$i],
          'title'=>$request['title'][$i],
          'roles'=>$request['roles'][$i],
          'qualification'=>$request['qualification'][$i],
          'training_vacc'=>$request['training_vacc'][$i]
        ]);
      }
    }


    $prf_details= DB::table('prf_protocol')
    ->select('prf_protocol.*', 'users.*','units.*','units.id as unit_id', 'users.name as inv_name')           
    ->leftjoin('users','prf_protocol.invest_id','=','users.id')
    ->leftjoin('units','prf_protocol.institute_id','=','units.id')
    ->where('prf_protocol.protocol_id',$id)->first();
    if($checkSubmit == 1){
      $prf=DB::table('prf_protocol')
      ->leftjoin('users','users.id','prf_protocol.invest_id')
      ->join('vw_protocol_status','prf_protocol.protocol_id','vw_protocol_status.protocol_id')
      ->where('prf_protocol.protocol_id', $id)
      ->first();
      if($prf->status == "MINOR REVISIONS"){    
        DB::table('protocol_status')->insert([
          'protocol_id'=>$request->protocol_id,
          'status'=>6,
          'created_by'=>Auth::user()->id
        ]);
        $prf_details= DB::table('prf_protocol')
           ->select('prf_protocol.*', 'users.*','units.*','units.id as unit_id', 'users.name as inv_name')           
           ->leftjoin('users','prf_protocol.invest_id','=','users.id')
           ->leftjoin('units','prf_protocol.institute_id','=','units.id')
           ->where('prf_protocol.protocol_id',$id)->first();
           
            $secretary=DB::table('users')
            ->select('users.*')
            ->leftjoin('user_roles', 'users.id', 'user_roles.user_id')
            ->where('user_roles.role_id', 4)
            ->first();
           $this->mailMinorToSec($prf_details, $secretary);
      }else if($prf->status == "REJECTED"){    
        DB::table('protocol_status')->insert([
          'protocol_id'=>$request->protocol_id,
          'status'=>6,
          'created_by'=>Auth::user()->id
        ]);
    }elseif($prf->status == "FOR APPROVAL SECRETARY"){
        DB::table('protocol_status')->insert([
          'protocol_id'=>$id,
          'status'=>6,
          'created_by'=>Auth::user()->id
        ]);
        $prf_details= DB::table('prf_protocol')
           ->select('prf_protocol.*', 'users.*','units.*','units.id as unit_id', 'users.name as inv_name')           
           ->leftjoin('users','prf_protocol.invest_id','=','users.id')
           ->leftjoin('units','prf_protocol.institute_id','=','units.id')
           ->where('prf_protocol.protocol_id',$id)->first();
           
            $secretary=DB::table('users')
            ->select('users.*')
            ->leftjoin('user_roles', 'users.id', 'user_roles.user_id')
            ->where('user_roles.role_id', 4)
            ->first();
           $this->mailRejectedToSec($prf_details, $secretary);
      }else{  
          if($prf->status == "CREATED"){
            $prf_details= DB::table('prf_protocol')
           ->select('prf_protocol.*', 'users.*','units.*','units.id as unit_id', 'users.name as inv_name')           
           ->leftjoin('users','prf_protocol.invest_id','=','users.id')
           ->leftjoin('units','prf_protocol.institute_id','=','units.id')
           ->where('prf_protocol.protocol_id',$id)->first();
           
            $units=DB::table('units')
            ->select('users.*')
            ->leftjoin('user_roles', 'units.id', 'user_roles.role_id')
            ->leftjoin('users', 'user_roles.user_id', 'users.id')
            ->where('user_roles.unit_id', $prf_details->unit_id)
            ->orderBy('user_roles.id', 'desc')
            ->first();
            $this->mailNewPRF($prf_details, $units);
          }

          if($prf->status == "RETURNED FROM UNIT"){
            $prf_details= DB::table('prf_protocol')
           ->select('prf_protocol.*', 'users.*','units.*','units.id as unit_id', 'users.name as inv_name')           
           ->leftjoin('users','prf_protocol.invest_id','=','users.id')
           ->leftjoin('units','prf_protocol.institute_id','=','units.id')
           ->where('prf_protocol.protocol_id',$id)->first();
           
            $units=DB::table('units')
            ->select('users.*')
            ->leftjoin('user_roles', 'units.id', 'user_roles.role_id')
            ->leftjoin('users', 'user_roles.user_id', 'users.id')
            ->where('user_roles.unit_id', $id)
            ->orderBy('user_roles.id', 'desc')
            ->first();
            $this->mailResubmitPRF($prf_details, $units);
          }

        DB::table('protocol_status')->insert([
          'protocol_id'=>$id,
          'status'=>2,
          'created_by'=>Auth::user()->id
        ]);
      }
    }

    return redirect('/prf?response=2');

  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function submit(Request $request)
    {
     
     //  $prf_details=DB::table('prf_protocol')
     //  ->select('prf_protocol.*', 'users.*','units.*', 'users.name as inv_name')
     //  ->leftjoin('users','prf_protocol.invest_id','=','users.id')
     //  ->leftjoin('units','prf_protocol.institute_id','=','units.id')
     //  ->where('protocol_id',$id)->first();
     //  dd($prf_details);

     //  Mail::send('emailtemplate.test', ['prf_details' => $prf_details], function ($m) use ($prf_details) {
     //    $m->from('hello@app.com', 'Your Application');

     //    $m->to('reginaldnmurillo@gmail.com', 'Reginald Murillo')->subject('Your Reminder!');

     //    if ($attachments) {
     //      foreach($attachments as $file)
     //      {
     //       $storage=public_path()."/storage/approval_attachment/";
     //       $m->attach($storage.$file->filename);

     //     }
     //   }

     // });

      $prf=DB::table('prf_protocol')
      ->leftjoin('users','users.id','prf_protocol.invest_id')
      ->join('vw_protocol_status','prf_protocol.protocol_id','vw_protocol_status.protocol_id')
      ->where('prf_protocol.protocol_id', $request->protocol_id)
      ->first();
      if($prf->status == "MINOR REVISIONS"){    
        DB::table('protocol_status')->insert([
          'protocol_id'=>$request->protocol_id,
          'status'=>6,
          'created_by'=>Auth::user()->id
        ]);
        $prf_details= DB::table('prf_protocol')
           ->select('prf_protocol.*', 'users.*','units.*','units.id as unit_id', 'users.name as inv_name')           
           ->leftjoin('users','prf_protocol.invest_id','=','users.id')
           ->leftjoin('units','prf_protocol.institute_id','=','units.id')
           ->where('prf_protocol.protocol_id',$request->protocol_id)->first();
           
            $secretary=DB::table('users')
            ->select('users.*')
            ->leftjoin('user_roles', 'users.id', 'user_roles.user_id')
            ->where('user_roles.role_id', 4)
            ->first();
           $this->mailMinorToSec($prf_details, $secretary);
      }elseif($prf->status == "FOR APPROVAL SECRETARY"){
        DB::table('protocol_status')->insert([
          'protocol_id'=>$request->protocol_id,
          'status'=>6,
          'created_by'=>Auth::user()->id
        ]);
      }else{  
          if($prf->status == "CREATED"){
            $prf_details= DB::table('prf_protocol')
           ->select('prf_protocol.*', 'users.*','units.*','units.id as unit_id', 'users.name as inv_name')           
           ->leftjoin('users','prf_protocol.invest_id','=','users.id')
           ->leftjoin('units','prf_protocol.institute_id','=','units.id')
           ->where('prf_protocol.protocol_id',$request->protocol_id)->first();
           
            $units=DB::table('units')
            ->select('users.*')
            ->leftjoin('user_roles', 'units.id', 'user_roles.role_id')
            ->leftjoin('users', 'user_roles.user_id', 'users.id')
            ->where('user_roles.unit_id', $prf_details->unit_id)
            ->orderBy('user_roles.id', 'desc')
            ->first();
            $this->mailNewPRF($prf_details, $units);
          }

          if($prf->status == "RETURNED FROM UNIT"){
            $prf_details= DB::table('prf_protocol')
           ->select('prf_protocol.*', 'users.*','units.*','units.id as unit_id', 'users.name as inv_name')           
           ->leftjoin('users','prf_protocol.invest_id','=','users.id')
           ->leftjoin('units','prf_protocol.institute_id','=','units.id')
           ->where('prf_protocol.protocol_id',$request->protocol_id)->first();
           
            $units=DB::table('units')
            ->select('users.*')
            ->leftjoin('user_roles', 'units.id', 'user_roles.role_id')
            ->leftjoin('users', 'user_roles.user_id', 'users.id')
            ->where('user_roles.unit_id', $prf_details->unit_id)
            ->orderBy('user_roles.id', 'desc')
            ->first();
            $this->mailResubmitPRF($prf_details, $units);
          }

          if($prf->status == "REJECTED"){
            $prf_details= DB::table('prf_protocol')
           ->select('prf_protocol.*', 'users.*','units.*','units.id as unit_id', 'users.name as inv_name')           
           ->leftjoin('users','prf_protocol.invest_id','=','users.id')
           ->leftjoin('units','prf_protocol.institute_id','=','units.id')
           ->where('prf_protocol.protocol_id',$request->protocol_id)->first();
           
            $secretary=DB::table('users')
            ->select('users.*')
            ->leftjoin('user_roles', 'users.id', 'user_roles.user_id')
            ->where('user_roles.role_id', 4)
            ->first();
           $this->mailRejectedToSec($prf_details, $secretary);
          }
        DB::table('protocol_status')->insert([
          'protocol_id'=>$request->protocol_id,
          'status'=>2,
          'created_by'=>Auth::user()->id
        ]);
      }

      return 1;
    }

    public function deleteCreated(Request $request){
      $protocol_id = $request->protocol_id;
      DB::table('prf_protocol')->where('protocol_id', '=', $protocol_id)->delete();
      DB::table('prf_protocol_animals')->where('protocol_id', '=', $protocol_id)->delete();
      DB::table('prf_protocol_personnel')->where('protocol_id', '=', $protocol_id)->delete();
      DB::table('prf_protocol_qualifications')->where('protocol_id', '=', $protocol_id)->delete();
      DB::table('prf_protocol_rs')->where('protocol_id', '=', $protocol_id)->delete();
      DB::table('protocol_status')->where('protocol_id', '=', $protocol_id)->delete();

      return 1;
    }

    public function mailNewPRF($prf_details, $units){
    
      \Mail::send('emailtemplate.newPRFSubmit', ['prf_details' => $prf_details, 'units' => $units], function ($m) use ($prf_details,$units) {
          $m->from('hello@app.com', 'New PRF Submission');
        
          $m->to($units->email)->subject('New PRF Submission');
        
          
      });

      \Mail::send('emailtemplate.newPRFSubmitMAil', ['prf_details' => $prf_details, 'units' => $units], function ($m) use ($prf_details,$units) {
        $m->from('hello@app.com', 'New PRF Submission');
      
        $m->to($prf_details->email)->subject('New PRF Submission');
      
        
    });
  }

  public function mailResubmitPRF($prf_details, $units){
    
    \Mail::send('emailtemplate.resubmitPRFMAil', ['prf_details' => $prf_details, 'units' => $units], function ($m) use ($prf_details,$units) {
        $m->from('hello@app.com', 'Reviewed PRF Resubmitted');
      
        $m->to($units->email)->subject('Reviewed PRF Resubmitted');
      
        
    });

 
}


public function mailRejectedToSec($prf_details, $secretary){
    
  \Mail::send('emailtemplate.resubmitInvMail', ['prf_details' => $prf_details, 'secretary' => $secretary], function ($m) use ($prf_details,$secretary) {
      $m->from('hello@app.com', 'PRF Resubmission');
    
      $m->to($secretary->email)->subject('PRF Resubmission');
    
      
  });
  
}
public function mailMinorToSec($prf_details, $secretary){
    
  \Mail::send('emailtemplate.resubmitMinorInvMail', ['prf_details' => $prf_details, 'secretary' => $secretary], function ($m) use ($prf_details,$secretary) {
      $m->from('hello@app.com', 'PRF Resubmission');
    
      $m->to($secretary->email)->subject('PRF Resubmission');
    
      
  });
  
}


  }
