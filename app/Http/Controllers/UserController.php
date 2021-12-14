<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use app\User;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
        $user_roles = [];
        $users = DB::table('users')->get();
        foreach ($users as $key => $value) {
           $roles = DB::table('user_roles')->select('roles.name')
                    ->leftjoin('roles','user_roles.role_id','roles.id')
                    ->leftjoin('units','user_roles.unit_id','units.id')
                    ->where('user_roles.user_id', $value->id)
                    ->get();
         $users[$key]->roles = array_merge($roles->toArray());
        }
        return view('user.main',array('users'=>$users));
    }

    public function create()
    {
        $roles=DB::table('roles')->get();
        $units=DB::table('units')->get();
        return view('user.create', ['roles' => $roles, 'units' => $units]);
    }

    public function store(Request $request)
    {
        // if($request->unit){
        //     $validated = $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|unique:users|email',
        //     'password' => 'required|min:6',
        //     'contact_number' => 'required|digits_between:8,11',
        //     'status' => 'required',
        //     'roles' => 'required',
        //     'unit' => 'required',
        // ],[
        //     'name.required' => 'Name is Required.',
        //     'email.required' => 'Email is Required.',
        //     'email.unique' => 'Email already exist.',
        //     'email.email' => 'Email must be valid email address.',            
        //     'password.min' => 'New Password must be at least 6 characters.',
        //     'password.required' => 'Password is Required.',
        //     'contact_number.required' => 'Contact Number is Required.',
        //     'contact_number.required' => 'Contact Number must be valid contact number.',
        //     'status.required' => 'Status is Required.',
        //     'roles.required' => 'Role is Required.',
        //     'unit.required' => 'Unit is Required.',
        // ]);
        // }else{
        //     $validated = $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|unique:users|email',
        //     'password' => 'required|min:6',
        //     'contact_number' => 'required|digits_between:8,11',
        //     'status' => 'required',
        //     'roles' => 'required',
        // ],[
        //     'name.required' => 'Name is Required.',
        //     'email.required' => 'Email is Required.',
        //     'email.unique' => 'Email already exist.',
        //     'email.email' => 'Email must be valid email address.',            
        //     'password.min' => 'New Password must be at least 6 characters.',
        //     'password.required' => 'Password is Required.',
        //     'contact_number.required' => 'Contact Number is Required.',
        //     'contact_number.required' => 'Contact Number must be valid contact number.',
        //     'status.required' => 'Status is Required.',
        //     'roles.required' => 'Role is Required.',
        // ]);
        // }
        
       
     try {
        DB::beginTransaction();
        $user_id = DB::table('users')->insertGetId([
            'honorifics'=>$request->honorifics,
            'name'=>$request->name,
            'email'=>$request->email,
            'password' => \Hash::make($request->password),
            'contact_number'=>$request->contact_number,
            'status'=>$request->status,

        ]);
        $roles = [];
        if (count($request->roles) == 1) {        
            $roles['user_id'] = $user_id;
            $roles['role_id'] = $request->roles[0];
            $roles['unit_id'] = $request->unit;
        }else{

            foreach ($request->roles as $key => $value) {
                
                $roles[$key]['user_id'] = $user_id;
                $roles[$key]['role_id'] = $value;
                $roles[$key]['unit_id'] = $request->unit;
            }
        }

        DB::table('user_roles')->insert($roles);        
        $this->mailNewUser($request->all());
        DB::commit();
        return redirect('/user?response=1');
    } catch (Exception $e) {        
        report($e);
        return false;
    }

}

 public function edit($id)
    {
        $user_roles = [];
        $roles=DB::table('roles')->get();
        $user = DB::table('users')->where('id', $id)->get();

           $user_roles = DB::table('user_roles')->select('roles.name','user_roles.unit_id','user_roles.role_id')
                    ->leftjoin('roles','user_roles.role_id','roles.id')
                    ->leftjoin('units','user_roles.unit_id','units.id')
                    ->where('user_roles.user_id', $id)
                    ->get();
            $user->roles = $user_roles;
         $roles=DB::table('roles')->get();
         $units=DB::table('units')->get();
         return view('user.edit', ['user' => $user,'roles' => $roles, 'units' => $units]);
    }

     public function update(Request $request,$id)
    {
       if($request->unit){
         $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'contact_number' => 'required|digits_between:8,11',
            'status' => 'required',
            'roles' => 'required',
            'unit' => 'required',
        ],[
            'name.required' => 'Name is Required.',
            'email.required' => 'Email is Required.',
            'email.email' => 'Email must be valid email address.',
            'contact_number.required' => 'Contact Number is Required.',
            'contact_number.required' => 'Contact Number must be valid contact number.',
            'status.required' => 'Status is Required.',
            'roles.required' => 'Role is Required.',
            'unit.required' => 'Unit is Required.',
        ]);
     }else{
         $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'contact_number' => 'required|digits_between:8,11',
            'status' => 'required',
            'roles' => 'required',
        ],[
            'name.required' => 'Name is Required.',
            'email.required' => 'Email is Required.',
            'email.email' => 'Email must be valid email address.',
            'contact_number.required' => 'Contact Number is Required.',
            'contact_number.required' => 'Contact Number must be valid contact number.',
            'status.required' => 'Status is Required.',
            'roles.required' => 'Role is Required.',
        ]);
     }
       
     try {
        DB::beginTransaction();
        DB::table('users')
              ->where('id', $id)
              ->update([
                'honorifics'=>$request->honorifics,
                'name'=>$request->name,
                'email'=>$request->email,
                'contact_number'=>$request->contact_number,
                'status'=>$request->status,
            ]);

              $roles = [];
              if (count($request->roles) == 1) {  
               $roles['user_id'] = $id;   
                $roles['role_id'] = $request->roles[0];
                $roles['unit_id'] = $request->unit;
            }else{

                foreach ($request->roles as $key => $value) {
                     $roles[$key]['user_id'] = $id;
                    $roles[$key]['role_id'] = $value;
                    $roles[$key]['unit_id'] = $request->unit;
                }
            }
            DB::table('user_roles')->where('user_id', $id)->delete();  
            DB::table('user_roles')->insert($roles);
        DB::commit();
        return redirect('/user/edit/'.$id.'?response=1');
    } catch (Exception $e) {        
        report($e);
        return false;
    }

}

public function changePassword()
    {
  
        return view('user.changePassword');
    }

public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'password' => ['required', new MatchOldPassword],
            'password1' => 'required|min:6',
            'password2' => 'required|same:password1',
        ],[
            'password1.required' => 'New Password is required.',
            'password1.min' => 'New Password must be at least 6 characters.',
            'password2.required' => 'Retype New Password is required.',
            'password2.same' => 'New Password and Retype New Password must match.'
        ]
    );
       
     try {
        DB::beginTransaction();
        DB::table('users')
              ->where('id', Auth::user()->id)
              ->update([
                'password'=> Hash::make($request->password1)
            ]);

        DB::commit();
        return redirect('/user/password?response=1');
    } catch (Exception $e) {        
        report($e);
        return false;
    }

}
public function changeUserPassword($id)
    {
  
        return view('user.changeUserPassword', ['id' => $id]);
    }

public function updateUserPassword(Request $request, $id)
    {
        $validated = $request->validate([
            'password1' => 'required|min:6',
            'password2' => 'required|same:password1',
        ],[
            'password1.min' => 'New Password must be at least 6 characters.',
            'password2.required' => 'Retype New Password is required.',
            'password2.same' => 'New Password and Retype New Password must match.'
        ]
    );
       
     try {
        DB::beginTransaction();
        DB::table('users')
              ->where('id', $id)
              ->update([
                'password'=> Hash::make($request->password1)
            ]);

        DB::commit();
         return redirect('/user/userPassword/'.$id.'?response=1');
    } catch (Exception $e) {        
        report($e);
        return false;
    }

}

    public function logout(Request $request) {
  Auth::logout();
  return redirect('/login');
}

public function mailNewUser($request){
    $rolesnew = [];
    $counter = 0;
    foreach($request['roles'] as $a){
        $rolesnew[$counter] = DB::table('roles')->select('name','id')->where('id', $a)->first();
        $counter++;
    }
    $unit = [];
    $count = 0;
    foreach($rolesnew as $role){
        if($role->name == "UNIT REPRESENTATIVE"){
            $unit[$count] = DB::table('units')->select('name', 'description')->where('id', $role->id)->first();
            $count++;
        }
    }
    $request['rolesnew'] = $rolesnew;
    $request['unit'] = $unit;
    \Mail::send('emailtemplate.newUserEmail', ['data' => $request], function ($m) use ($request) {
        $m->from('hello@app.com', 'Registration successful');
      
        $m->to($request['email'])->subject('Registration successful');
      
        
    });
}

}
