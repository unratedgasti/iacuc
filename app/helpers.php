<?php
use Illuminate\Support\Facades\DB;

function getuserdetails()
{
	if(Auth::check())
    {
	$user_type=\App\Member::where('user_id',Auth::user()->id)->select('*')->first();

	if($user_type==null)
	{

		$user_type='admin';
	}
	else
	{
		$user_type='member';
	}
	if($user_type=='member')
	{
	$user=\App\User::where('users.id',Auth::user()->id)
	->select('*','member.id as member_id','users.id as user_id','campus.name as campus_name','position.name as position_name')
	->leftjoin('member','users.id','=','member.user_id')
	->leftjoin('member_detail','member.member_no','=','member_detail.member_no')
	->leftjoin('campus','member.campus_id','=','campus.id')
	->leftjoin('position','member.position_id','=','position.id')
	->first();
	 $user['usertype']=$user_type;
	}
	else
	{
	$user=\App\User::where('users.id',Auth::user()->id)
	->select('*','admin.id as admin_id','users.id as user_id')
	->leftjoin('admin','users.id','=','admin.user_id')
	->leftjoin('cluster','admin.cluster_id','=','cluster.id')
	->first();
	$user['usertype']=$user_type;
	}
	return $user;
    }
    else
    {
    	 return redirect('login');
    }


}

function isadmin()
{
	if(Auth::check())
    {
      $valid=DB::table('user_roles')->where('user_id',Auth::user()->id)->where('role_id',1)->first();
      if($valid)
      {
      	return true;
      }
      else
      {
      	return false;
      }
    }
    else
    {
    	return redirect('login');
    }
}

function isinvestigator()
{
	if(Auth::check())
    {
      $valid=DB::table('user_roles')->where('user_id',Auth::user()->id)->where('role_id',2)->first();
      if($valid)
      {
      	return true;
      }
      else
      {
      	return false;
      }
    }
    else
    {
    	return redirect('login');
    }
}

function isunitrep()
{
	if(Auth::check())
    {
      $valid=DB::table('user_roles')->where('user_id',Auth::user()->id)->where('role_id',3)->first();
      if($valid)
      {
      	return true;
      }
      else
      {
      	return false;
      }
    }
    else
    {
    	return redirect('login');
    }
}

function issecretary()
{
	if(Auth::check())
    {
      $valid=DB::table('user_roles')->where('user_id',Auth::user()->id)->where('role_id',4)->first();
      if($valid)
      {
      	return true;
      }
      else
      {
      	return false;
      }
    }
    else
    {
    	return redirect('login');
    }
}

function getUserRole(){
  if(Auth::check())
    {
	 $user_roles = DB::table('user_roles')
                    ->leftjoin('roles','user_roles.role_id','roles.id')
                    ->leftjoin('units','user_roles.unit_id','units.id')
                    ->where('user_roles.user_id', Auth::user()->id)
                    ->pluck('user_roles.role_id');

                    return Arr::flatten($user_roles);
      }
      else
      {

      return redirect('login');
    }
}
