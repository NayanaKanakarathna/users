<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\users;
use Auth;
use Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if($user->user_level == "Super admin")
        {
            $users = users::OrderBy('created_at','asc')->get();
            return view("user.list")->with('users',$users);
        }
        else{
            return view('home');
        }
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
        $user = users::findOrFail($id);
        return view('user.create',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        if($request->user_level != "Super admin")
        {           
            $this->validate(request(),[
                'name' => 'required',
                'email' => 'required',
                'user_level' => 'required',
                'birthday' => 'required',
                'department' => 'required',
            ]);
        }
        else
        {
            $this->validate(request(),[
                'name' => 'required',
                'email' => 'required',
                'user_level' => 'required',
            ]);
        }

        $users            = users::find($id);
        $users->name      = $request->name;
        $users->email     = $request->email;
        $users->user_level= $request->user_level;
        $users->birthday  = $request->birthday;
        $users->department= $request->department;
        $users->save();

        return redirect('/user')->with('status', 'User profile modified successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        users::where('id',$id)->delete();
        return redirect('/user')->with('status_delete','Category Deleted !');
    }

    public function add_bulk()
    {

        return view("user.add_bulk");

    }

    public function upload_users(Request $request)
    {
        $this->validate($request, [
          'fileToUpload'  => 'required|mimes:xls,xlsx'
        ]);

        $path = $request->file('fileToUpload')->getRealPath();

        $data = Excel::load($path)->get();

        if($data->count() > 0)
        {
            foreach($data->toArray() as $key => $value)
            {
                $birthday= $value['birthday']->toDateTimeString();
                $user_old = users::Where('email', $value['email_address'])->get();

                if(!empty($user_old))
                {
                    $users            = users::find($user_old[0]->id);
                    $users->name      = $request->name;
                    $users->email     = $request->email;
                    $users->user_level= $request->user_level;
                    $users->birthday  = $request->birthday;
                    $users->department= $request->department;
                    $users->save();
                }
                else
                {
                    $users = new Users;
                    $users->name = $value['user_name'];
                    $users->email =  $value['email_address'];
                    $users->password = bcrypt($value['password']);
                    $users->user_level = $value['user_role'];
                    $users->birthday = date("Y-m-d", strtotime($birthday)) ;
                    $users->department = $value['department'];
                    $users->save();                    
                }
            }
        }
        return redirect('/user')->with('status','Excel Data Imported successfully.');
    }
}
