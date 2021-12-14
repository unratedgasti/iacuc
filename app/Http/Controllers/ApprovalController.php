<?php

namespace App\Http\Controllers;

use Mail;
use Illuminate\Http\Request;
use DB;
use Auth;
use PDF;

class ApprovalController extends Controller
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
     $prf=array();
     $prfmain=array();
     $prfpartner=array();

     if(in_array(1,getUserRole()))
     {
       $prf=DB::table('prf_protocol')
       ->leftjoin('users','users.id','prf_protocol.invest_id')
       ->join('vw_protocol_status','prf_protocol.protocol_id','vw_protocol_status.protocol_id')
       ->whereIn('vw_protocol_status.status', array('FOR APPROVAL UNIT', 'FOR APPROVAL PARTNER UNIT', 'FOR APPROVAL SECRETARY','MINOR REVISIONS'))
        ->where('prf_protocol.invest_id', Auth::user()->id)
       ->get();               
     }
     elseif(in_array(3,getUserRole()))
     {
       $units=DB::table('user_roles')->select('unit_id')->where('user_id',Auth::user()->id)->where('role_id',3)->first();

       $unit=$units->unit_id;
       $prfmain=DB::table('prf_protocol')
       ->leftjoin('users','users.id','prf_protocol.invest_id')
       ->join('vw_protocol_status','prf_protocol.protocol_id','vw_protocol_status.protocol_id')
       ->where('prf_protocol.institute_id',$unit)
       ->where('vw_protocol_status.status', 'FOR APPROVAL UNIT')
       ->get();



     }
     elseif(in_array(4,getUserRole()))
     {
       $prf=DB::table('prf_protocol')
       ->leftjoin('users','users.id','prf_protocol.invest_id')
       ->join('vw_protocol_status','prf_protocol.protocol_id','vw_protocol_status.protocol_id')
       ->where('vw_protocol_status.status', 'FOR APPROVAL SECRETARY')
       ->get();
     }




     return view('approval.main',array('prf'=>$prf, 'prfmain'=>$prfmain));
   }

   public function process_approval($id)
   {
    $prf_details=DB::table('prf_protocol')
    ->select('prf_protocol.*', 'users.*','units.*', 'users.name as inv_name')
    ->leftjoin('users','prf_protocol.invest_id','=','users.id')
    ->leftjoin('units','prf_protocol.institute_id','=','units.id')
    ->where('protocol_id',$id)->first();

    return view('approval.process_approval',array('prf_details'=>$prf_details));
  }

  public function upload_attachment(Request $request)
  {
    $randomstring=self::generateRandomString(8);
    $target_dir = public_path()."/storage/approval_attachment/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $temp = $_FILES["file"]["name"];
    $file_ext = substr($temp, strripos($temp, '.'));
    $uploadOk = 1;

    $newfilename = 'prf_id-'.$request->prf_id.'-approval_attachment-'.$randomstring.$file_ext;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir.$newfilename);
    $id =DB::table('approval_attachments')->insertGetId([
      'protocol_id'=>$request->prf_id,
      'filename'=>$newfilename,
      'original_filename'=>$temp,
      'uploaded_by'=>Auth::user()->id
    ]);


    return $id;
  }

  public function generateRandomString($length = 10) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
  }

  public function remove_attachment(Request $request)
  {

    $attachment_id=$request->attachment_id;

    $attachment=DB::table('approval_attachments')
    ->where('id', $attachment_id)
    ->first(); 


    $loc=public_path()."/storage/approval_attachment/";

    unlink($loc.$attachment->filename);

    DB::table('approval_attachments')->where('id',  $attachment_id)->delete();


    return  1;
  }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function return_to_investigator(Request $request)
    {
      
     $currentstatus=DB::table('vw_protocol_status')->where('protocol_id',$request->protocol_id)->first();
      
     if($currentstatus->status=='FOR APPROVAL UNIT')
     {
      DB::table('unit_reviews')
      ->where('id', $request->review_id)
      ->update(['review_status'=>'RETURNED']);

      DB::table('protocol_status')->insert([
        'protocol_id'=>$request->protocol_id,
        'status'=>3,
        'created_by'=>Auth::user()->id
      ]);
      $this->mailReturnPRF($request->all());
    }

    return 1;
  }

  public function approve_prf(Request $request)
  {
   $currentstatus=DB::table('vw_protocol_status')->where('protocol_id',$request->protocol_id)->first();

   if($currentstatus->status=='FOR APPROVAL UNIT')
   {
   
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
    $this->mailApprovedUnit($prf_details, $secretary);
    DB::table('unit_reviews')
    ->where('id', $request->review_id)
    ->update(['review_status'=>'Approve by Unit']);

    DB::table('protocol_status')->insert([
      'protocol_id'=>$request->protocol_id,
      'status'=>6,
      'created_by'=>Auth::user()->id
    ]);
  }

  $current_year=date('Y');

  $control=DB::table('prf_series')->where('type','PRF')->first();
  if($control->year==$current_year)
  {
    $current_counter=$control->current_counter+1;
    $counter_digits=str_pad($current_counter, $control->counter_length, '0', STR_PAD_LEFT);
    $current_last='PRF-'.$control->year.'-'.$counter_digits;
    DB::table('prf_series')
    ->where('type', 'PRF')
    ->update(['current_last' => $current_last,'current_counter' => $current_counter]);


  }
  else
  {
    $year=$current_year;
    $current_counter=0+1;
    $counter_digits=str_pad($current_counter, $control->counter_length, '0', STR_PAD_LEFT);
    $current_last='PRF-'.$control->year.'-'.$counter_digits;
    DB::table('prf_series')
    ->where('type', 'PRF')
    ->update(['year'=>$year,'current_last' =>  $current_last,'current_counter' => $current_counter]);


  }

  $tosave=[];
  $tosave['purpose'] = "";
  $tosave['protocol_no']= "";

  if($tosave['purpose']=='RESEARCH')
  {
    $protocol_no= $current_last.'-R';
  }
  else
  {
   $protocol_no= $current_last.'-T';
 }

 /*$tosave['protocol_no']=$protocol_no;

 DB::table('prf_protocol')
 ->where('protocol_id', $request->protocol_id)
 ->update($tosave);*/

 return 1;
}

public function sec_approval_submit(Request $request)
{
  
  $prf_details= DB::table('prf_protocol')
  ->select('prf_protocol.*', 'users.*','units.*','units.id as unit_id', 'users.name as inv_name')           
  ->leftjoin('users','prf_protocol.invest_id','=','users.id')
  ->leftjoin('units','prf_protocol.institute_id','=','units.id')
  ->where('prf_protocol.protocol_id',$request->protocol_id)->first();
   
$attachments=DB::table('approval_attachments')->where('protocol_id',$request->protocol_id)->get();
if($request->radiobtns == "Approved"){
  
       DB::table('unit_reviews')
       ->where('protocol_id', $request->protocol_id)
       ->update(['review_status'=>'FINAL APPROVED']);

       DB::table('protocol_status')->insert([
        'protocol_id'=>$request->protocol_id,
        'status'=>8,
        'created_by'=>Auth::user()->id
      ]);

       DB::table('unit_reviews')
       ->where('id', $request->review_id)
       ->update(['review_status'=>'Approve by Secretary']);


      
       \Mail::send('emailtemplate.approvedSecMail', ['prf_details' => $prf_details, 'attachments'=>$attachments], function ($m) use ($prf_details, $attachments) {
        $m->from('hello@app.com', 'PRF Review Result');
      
        $m->to($prf_details->email)->subject('PRF Review Result');
              if ($attachments) {
          foreach($attachments as $file)
          {
          $storage=public_path()."/storage/approval_attachment/";
          $m->attach($storage.$file->filename);
          
        }
      }
        
    });
}else if($request->radiobtns == "Approved with revisions"){
   DB::table('unit_reviews')
      ->where('protocol_id', $request->protocol_id)
      ->update(['review_status'=>'MINOR REVISIONS']);

      DB::table('protocol_status')->insert([
        'protocol_id'=>$request->protocol_id,
        'status'=>7,
        'created_by'=>Auth::user()->id
      ]);

      \Mail::send('emailtemplate.approvedMinorSecMail', ['prf_details' => $prf_details, 'attachments'=>$attachments], function ($m) use ($prf_details, $attachments) {
        $m->from('hello@app.com', 'PRF Review Result');
      
        $m->to($prf_details->email)->subject('PRF Review Result');
              if ($attachments) {
          foreach($attachments as $file)
          {
          $storage=public_path()."/storage/approval_attachment/";
          $m->attach($storage.$file->filename);
          
        }
      }
        
    });
    
   
}else{
      DB::table('unit_reviews')
      ->where('protocol_id', $request->protocol_id)
      ->update(['review_status'=>'MINOR REVISIONS']);

      DB::table('protocol_status')->insert([
        'protocol_id'=>$request->protocol_id,
        'status'=>9,
        'created_by'=>Auth::user()->id
      ]);
      DB::table('unit_reviews')
       ->where('id', $request->review_id)
       ->update(['review_status'=>'Rejected by Secretary']);

       \Mail::send('emailtemplate.resubmitSecMail', ['prf_details' => $prf_details, 'attachments'=>$attachments], function ($m) use ($prf_details, $attachments) {
        $m->from('hello@app.com', 'PRF Review Result');
      
        $m->to($prf_details->email)->subject('PRF Review Result');
              if ($attachments) {
          foreach($attachments as $file)
          {
          $storage=public_path()."/storage/approval_attachment/";
          $m->attach($storage.$file->filename);
          
        }
      }
        
    });
    
}

 $prf_details=DB::table('prf_protocol')
 ->select('*','users.name as name')
 ->leftjoin('users','prf_protocol.invest_id','=','users.id')
 ->leftjoin('units','prf_protocol.institute_id','=','units.id')
 ->where('protocol_id',$request->protocol_id)->first();


 $data['investigator_name']=$prf_details->name;
 $data['protocol_no']=$prf_details->protocol_no;
 $data['investigator_name']=$prf_details->name;
 $data['approval']=$request->radiobtns;
 $data['notes']=$request->protocol_comments;
/*    $user = User::findOrFail($id);
         Mail::send('emails.reminder', ['user' => $user], function ($m) use ($user) {
            $m->from('hello@app.com', 'Your Application');

            $m->to('reginaldnmurillo@gmail.com', 'Reginald Murillo')->subject('Your Reminder!');
        });*/

//  $user=$data;
//  Mail::send('emailtemplate.secretary-approval', ['user' => $user,'attachments'=>$attachments], function ($m) use ($user, $attachments) {
//   $m->from('hello@app.com', 'Your Application');

//   $m->to('danieltinao@gmail.com', 'Reginald Murillo')->subject('Your Reminder!');

//   if ($attachments) {
//     foreach($attachments as $file)
//     {
//      $storage=public_path()."/storage/approval_attachment/";
//      $m->attach($storage.$file->filename);
     
//    }
//  }

// });
return redirect('/approvals');
}

public function view($id)
{
  if(in_array(3,getUserRole()))
  {
    $unit_id=DB::table('user_roles')->where('user_id',Auth::user()->id)->where('role_id',3)->first();
    $existing=DB::table('unit_reviews')->where('protocol_id',$id)->where('unit_id',$unit_id->unit_id)->first();
    if($existing)
    {
      return redirect('/approvals/edit-review/'.$id);
    }
  }
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
  ->leftjoin('ref_status','protocol_status.status','=','ref_status.id')->where('protocol_id',$id)->orderByDesc('date_created')->first();


  return view('approval.view',array('prf_details'=>$prf_details,'prf_animals'=>$prf_animals, 'prf_personnel'=>$prf_personnel, 'prf_qualifications'=>$prf_qualifications, 'prf_rs'=>$prf_rs, 'prf_status'=>$prf_status));
}

public function generate_comment_form($id)
{

  $prf=DB::table('prf_protocol')
  ->select('prf_protocol.*', 'users.*','users.*')
  ->leftjoin('unit_reviews','prf_protocol.protocol_id','=','unit_reviews.protocol_id')
  ->leftjoin('users', 'unit_reviews.created_by','=','users.id')
  ->where('prf_protocol.protocol_id',$id)->first();
  PDF::setOptions(["isPhpEnabled" => true]);
  $data['prf_no']=$prf->protocol_no;
  $pdf = PDF::loadView('approval.pdf.comment_form', array('data' => $data, 'prf_details' => $prf));
  return $pdf->stream('comment_form.pdf');
}

public function generate_prf($id)
{
  $prf=DB::table('prf_protocol')
  
  ->select('prf_protocol.*', 'users.*','units.*', 'users.name as inv_name')
  ->leftjoin('users','prf_protocol.invest_id','=','users.id')
  ->leftjoin('units','prf_protocol.institute_id','=','units.id')
  ->where('protocol_id',$id)->first();

  $prf_rs=DB::table('prf_protocol_rs')->where('protocol_id',$id)->get();
  $prf_qualifications=DB::table('prf_protocol_qualifications')->where('protocol_id',$id)->get();
  $prf_animals=DB::table('prf_protocol_animals')->where('protocol_id',$id)->get();
  $prf_personnel=DB::table('prf_protocol_personnel')->where('protocol_id',$id)->get();

  // dd($prf);

  $headers = array(

    "Content-type"=>"text/html",

    "Content-Disposition"=>"attachment;Filename=myGeneratefile.doc"

  );



  $content = '<html>

  <head><meta charset="utf-8"></head>

  <body>
  <div>
  <strong>Protocol Review #:</strong>&nbsp;'.$prf->protocol_no.'
  </div>
  <br/>
  <div>
  <strong>I. PROTOCOL</strong>
  <ol type="A">
  <li><strong>Name of protocol or procedure</strong><br/>'.$prf->protocol_name.'</li>
  <li><strong>Title/s of research/study</strong><br/>';
  foreach ($prf_rs as $study) {
    $content.= $study->research_study.'<br/>';
  }

  $content.='</li>
  <li><strong>Source/s of funding</strong><br/>'.$prf->funding_source.'</li>
  <li><strong>Previous Protocol Review</strong> <br/>'.$prf->prev_protocol_no.'</li>
  </ol>
  <br/>
  <strong>II. OBJECTIVE/S</strong>
  <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$prf->objectives.'
  <br/>
  <br/>
  <strong>III. DURATION</strong>
  <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>Give the start month and year, and the duration of the project/thesis.</i>
  <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.date("m-d-Y", strtotime(str_replace(".", "/", $prf->date_from))).'&nbsp; to &nbsp;'.date("m-d-Y", strtotime(str_replace(".", "/", $prf->date_to))).'
  <br/>
  <br/>
  <strong>IV. PRINCIPAL INVESTIGATOR</strong>
  <ol type="A">
  <li><strong>Name:</strong>&nbsp;'.$prf->inv_name.'</li>
  <li><strong>Qualifications</strong><br/>';

  foreach ($prf_qualifications as $qual) {
    $content.= $qual->qualification_desc.'<br/>';
  }

  $content.='</li>
  <li><strong>Contact Information</strong><br/><br/>
  <strong>Email address:&nbsp;</strong>'.$prf->email.'<br/>
  <strong>Contact number:&nbsp;</strong>'.$prf->contact_number.'</li>
  </ol>
  <br/>
  <strong>V. BACKGROUND AND SIGNIFICANCE OF THE PROCEDURE OR RESEARCH</strong>
  <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>Include a description of the biomedical characteristics of the animals which are essential to the proposed procedure/research and indicate evidence of experiences with the proposed animal model.</i>
  <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$prf->background_significance.'
  <br/>
  <br/>
  <strong>VI. DESCRIPTION OF METHODOLOGIES/EXPERIMENTAL DESIGN</strong>
  <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>This section should establish that the proposed procedure is well designed scientifically and ethically</i>
  <ol type="A">
  <li><strong>Animals</strong></li>
  <div align="center">
  <table border="1" width="120%"  style="font-size: 14px;" >
  <tr>
  <th><strong>Species</strong></th>
  <th><strong>Strain</strong></th>
  <th><strong>Source</strong></th>
  <th><strong>Age</strong></th>
  <th><strong>Weight</strong></th>
  <th><strong>Sex</strong></th>
  <th><strong>Number</strong></th>
  </tr>';
  foreach ($prf_animals as $animal){
   $content.='<tr>
   <td>'.$animal->species.'</td>
   <td>'.$animal->strain.'</td>
   <td>'.$animal->source.'</td>
   <td>'.$animal->age.'</td>
   <td>'.$animal->weight.'</td>
   <td>'.$animal->sex.'</td>
   <td>'.$animal->number.'</td>
   </tr>';
 }

 $content.='</table></div>
 <br/>
 <li><strong>Basis for selecting the animal species</strong>
 <br/><i>Give the reason/s for the use of the animals and justify the number of animals that will be used.</i> 
 <br/>'.$prf->basis_in_selecting.'</li>
 <br/>
 <li><strong>Quarantine and/or conditioning process</strong>
 <br/>'.$prf->quarantine_conditioning.'</li>
 <br/>
 <li><strong>Animal care procedures</strong>
 <ol>
 <li><strong>Cage type</strong>
 <br/><i>Give the type, material, and dimensions of the cage that will house the animals.</i> 
 <br/>'.$prf->cage_type.'</li>
 <li><strong>Number of animals per sex per cage</strong> 
 <br/>'.$prf->num_animals.'</li>
 <li><strong>Identification</strong>
 <br/><i>Indicate how each individual animal will be identified from one another.</i> 
 <br/>'.$prf->identification_animals.'</li>
 <li><strong>Cage cleaning method</strong>
 <br/>'.$prf->cage_cleaning.'</li>
 <li><strong>Living conditions</strong>
 <br/><i>Include where the animals will be housed, the room temperature, humidity, ventilation, and lighting.</i> 
 <br/>'.$prf->living_condition.'</li>
 <li><strong>6. Animal diet, and feeding and watering method</strong>
 <br/>'.$prf->animal_diet.'</li>
 </ol>
 </li>
 <li><strong>Experimental or animal manipulation methods</strong>
 <ol>
 <li><strong>Genral description</strong>
 <br/><i>Give a description of the methods of animal manipulation that will be used including the method of conditioning.</i> 
 <br/>'.$prf->method_desc.'</li>
 <li><strong>Location</strong>
 <br/><i>Indicate where the animal manipulation method will be performed.</i> 
 <br/>'.$prf->method_location.'</li>
 <li><strong>Dosing</strong>
 <br/><i>Include the frequency, volume, route, method of restraint and expected outcome or effects.</i> 
 <br/>'.$prf->method_dosing.'</li>
 <li><strong>Specimen and/or biological collection</strong>
 <br/><i>Include the frequency, volume, route, and method of restraint for each specimen and/or biological agent that will be collected.</i> 
 <br/>'.$prf->method_collection.'</li>
 <li><strong>Animal examination procedure/s</strong>
 <br/><i>Include the frequency of examinations and the method of restraint.</i> 
 <br/>'.$prf->method_examination.'</li>
 <li><strong>Use of anesthetics</strong>
 <br/><i>Include the drug, dosage, and frequency.Include the drug, dosage, and frequency.</i> 
 <br/>'.$prf->method_anesthetics.'</li>
 <li><strong>Surgical procedure/s</strong>
 <br/><i>If the protocol involves any surgical procedure, include the following information:<br/>
 <ol type="a" style="padding-bottom:0; margin-bottom:0;">
 <li>Place where surgery will be performed</li>
 <li>Description of supportive care and monitoring procedures during and after surgery</li>
 <li>Description of measures for possible post-surgical complications</li>
 <li>Name of all participating surgeons and their qualifications and relevant experience</li>
 </ol></i> 
 <br/ ><pre ><font face="Times New Roman", Times, serif size="3">'.$prf->method_surgical.'</font></pre>
 <li><strong>Humane endpoints</strong>
 <br/><i>Describe the plan for monitoring pain, discomfort, or distress during and after the procedure. If animals will be euthanized, include the method that will be used.</i> 
 <br/>'.$prf->humane_endpoint.'</li>

 </ol>
 </li>
 <br/>

 <li><strong>Potential hazards</strong>
 <br/><i>Include any potential hazards for the animals and the personnel involved as well as preventive measures to avoid hazards.</i> 
 <br/>'.$prf->potential_hazards.'</li>
 <br/> 

 <li><strong>Waste Disposal</strong>
 <br/><i>Describe how animal carcasses and other wastes generated by the procedure will be disposed of.</i> 
 <br/>'.$prf->waste_disposal.'</li>
 <br/> 

 <li><strong>Suitable alternatives</strong>
 <br/><i>Is there a non-animal model applicable for the procedure/study? If so, please provide the reasons for not using it.</i> 
 <br/>'.$prf->suitable_alternatives.'</li>
 <br/>

 <li><strong>Other Personnel</strong></li>
 <div align="center">
 <table border="1" width="120%"  style="font-size: 14px;" >
 <tr>
 <th><strong>Name</strong></th>
 <th><strong>Title</strong></th>
 <th><strong>Roles</strong></th>
 <th><strong>Qualifications</strong></th>
 <th><strong>Training and Vaccinations*</strong></th>
 </tr>';
 foreach ($prf_personnel as $per){
   $content.='<tr>
   <td>'.$per->name.'</td>
   <td>'.$per->title.'</td>
   <td>'.$per->roles.'</td>
   <td>'.$per->qualification.'</td>
   <td>'.$per->training_vacc.'</td>
   </tr>';
 }

 $content.='</table></div>


 </ol>
 <br/>
 <strong>VII. References</strong>
 <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>List all the reference materials used for this protocol.</i>
 <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<pre ><font face="Times New Roman", Times, serif size="3">'.$prf->other_reference.'</font>
 <br/>
 <br/>';


 $content .= '
 </body>

 </html>';



 return \Response::make($content,200, $headers);



}

public function generate_forms($id)
{
  $prf_details=DB::table('prf_protocol')
  ->select('prf_protocol.*', 'users.*','units.*', 'users.name as inv_name')
  ->leftjoin('users','prf_protocol.invest_id','=','users.id')
  ->leftjoin('units','prf_protocol.institute_id','=','units.id')
  ->where('protocol_id',$id)->first();

  return view('approval.generate_forms',array('prf_details'=>$prf_details));
  
}


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save_review(Request $request)
    {

      $data=$request->all();
      unset($data['_token']);
      $protocol_id=$request->protocol_id;

      $currentstatus=DB::table('vw_protocol_status')
      ->where('protocol_id',$protocol_id)
      ->first();
      
      $prfdetails=DB::table('prf_protocol')
      ->where('protocol_id',$protocol_id)
      ->first();
      $data['protocol_id']=$protocol_id;

      if($currentstatus->status=='FOR APPROVAL UNIT')
      {

        $unit_id=DB::table('user_roles')->where('user_id',Auth::user()->id)->where('role_id',3)->first();
        $data['is_approval_unit']=1;
        $data['is_secretary']=0;
        $data['unit_id']=(isset($unit_id->unit_id)) ? $unit_id->unit_id : $prfdetails->institute_id;
        $data['created_by']=Auth::user()->id;
        $data['review_status']='SAVED';
        DB::table('unit_reviews')->insert($data);


      }
      elseif($currentstatus->status=='FOR APPROVAL SECRETARY')
      {
        $data['is_approval_unit']=0;
        $data['is_secretary']=1;
        $data['unit_id']=0;
        $data['created_by']=Auth::user()->id;
        $data['review_status']='SAVED';
        DB::table('unit_reviews')->insert($data);
      }

      return redirect('/approvals/edit-review/'.$protocol_id)->with('status', 'Review Saved');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_review($id)
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

      if($currentstatus->status=='FOR APPROVAL UNIT')
      {
       $unit_id=DB::table('user_roles')->where('user_id',Auth::user()->id)->where('role_id',3)->first();
       $prfdetails=DB::table('prf_protocol')
       ->where('protocol_id',$id)
       ->first();
       
       $unit=(isset($unit_id->unit_id)) ? $unit_id->unit_id : $prfdetails->institute_id;
       $review_details=DB::table('unit_reviews')->where('protocol_id',$id)->where('unit_id',$unit)->first();
     }
     elseif($currentstatus->status=='FOR APPROVAL SECRETARY')
     {
      $review_details=DB::table('unit_reviews')->where('protocol_id',$id)->where('is_secretary',1)->first();
    }

    return view('approval.edit',array('prf_details'=>$prf_details,'prf_animals'=>$prf_animals, 'prf_personnel'=>$prf_personnel, 'prf_qualifications'=>$prf_qualifications, 'prf_rs'=>$prf_rs, 'prf_status'=>$prf_status,'review_details'=>$review_details));
  }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_review(Request $request, $id)
    {

      $data=$request->all();
      $review_id=$request->review_id;
      unset($data['_token']);
      unset($data['review_id']);

      DB::table('unit_reviews')
      ->where('id', $review_id)
      ->update($data);
      return redirect('/approvals/edit-review/'.$id)->with('status', 'Review Updated');
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

    public function updateProtocol(Request $request){
      $protocol_id = $request->protocol_id;
      DB::table('prf_protocol')
      ->where('protocol_id', $protocol_id)
      ->update(["protocol_no" => $request->protocol_no]);
      return redirect('/approvals?response=3');
    }

    public function updateCategory(Request $request){
      $protocol_id = $request->protocol_id;
      DB::table('prf_protocol')
      ->where('protocol_id', $protocol_id)
      ->update(["category" => $request->category]);
      return redirect('/approvals?response=4');
    }

    public function updateDuration(Request $request){
      $date_from=date('Y-m-d', strtotime($request->date_from));
      $date_to=date('Y-m-d', strtotime($request->date_to));
      $protocol_id = $request->protocol_id;
      DB::table('prf_protocol')
      ->where('protocol_id', $protocol_id)
      ->update(["date_from" => $date_from, "date_to" => $date_to]);
      return redirect('/approved?response=1');
    }

    public function mailReturnPRF($prf){
    
    $prf_details= DB::table('prf_protocol')
    ->select('prf_protocol.*', 'users.*','units.*','units.id as unit_id', 'users.name as inv_name')           
    ->leftjoin('users','prf_protocol.invest_id','=','users.id')
    ->leftjoin('units','prf_protocol.institute_id','=','units.id')
    ->where('prf_protocol.protocol_id',$prf['protocol_id'])->first();

      \Mail::send('emailtemplate.returnPRFMAil', ['prf_details' => $prf_details], function ($m) use ($prf_details) {
          $m->from('hello@app.com', 'PRF Submission Returned');
        
          $m->to($prf_details->email)->subject('PRF Submission Returned');
        
          
      });   
  }
  public function mailApprovedUnit($prf_details, $secretary){
    
    \Mail::send('emailtemplate.approveUnitMail', ['prf_details' => $prf_details, 'secretary' => $secretary], function ($m) use ($prf_details,$secretary) {
        $m->from('hello@app.com', 'New PRF Forwarded');
      
        $m->to($secretary->email)->subject('New PRF Forwarded');
      
        
    });

    \Mail::send('emailtemplate.approveUnitInvMail', ['prf_details' => $prf_details], function ($m) use ($prf_details) {
      $m->from('hello@app.com', 'PRF Submission Forwarded');
    
      $m->to($prf_details->email)->subject('PRF Submission Forwarded');
    
      
  });
}


  }
