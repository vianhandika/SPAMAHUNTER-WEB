<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\UserTransformers;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Mail\SendVerification;

class UserController extends RestController
{
    protected $transformer = UserTransformers::Class;

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //Get All User
    {
        $users = User::get();
        $response = $this->generateCollection($users);
        return $this->sendResponse($response, 201);  

    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

    }

    //POST---------------------------------------------------------------------------------------------
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //Register
    {
        // return response()->json(['Failed To Register'=>'Failed'], 400);
        $this->validate($request, [
            'username'      => 'required',
            'email'         => 'required|email|unique:users',
            'password'      => 'required|min:6',
        ]);

        
        try {

            $created = User::create([
                'username'      => $request->username,
                // 'password'      => md5($request->password),
                'password'      => bcrypt(request('password')),
                'email'         => $request->email,
                'role'          => 2,
                'status'        => 0,
                'verifycode'    => md5(rand(0,10000)),
                'picture'       => '',
            ]);
            // $users = User::where('username',$request->username)->first();
            // Mail::to($created->email)->send(new SendVerification($created));
            $response = $this->generateItem($created);
            return $this->sendResponse($response, 201);            

        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
            // return response()->json(['Failed To Register'=>'Failed'], 400);
        }

    }

    //GET---------------------------------------------------------------------------------------------
     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) //Get User By ID
    {
        try{

            $users = User::find($id);
            
            $response = $this->generateItem($users);
            return $this->sendResponse($response, 201);

        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }

    }

    //PUT---------------------------------------------------------------------------------------------
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

    }

    public function changePassword(Request $request, $id) //Change Password
    {
        $this->validate($request, [
            'newPassword' => 'required|min:6'
        ]);

        try {
            $users = User::find($id);
            $users->password = md5($request->newPassword);
            $users->save();
            
            // $response = $this->generateItem($users);
            // return $this->sendResponse($response, 201);
            
            return response()->json('Success',201);

        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
        
    }

    public function changeUserPicture(Request $request, $id)
    {

        try {
            $users = User::find($id);
            
            if($request->hasfile('images'))
            {
                $file = $request->file('images');
                $name=$users->username.".jpg";
                $file->move(public_path().'/images/profile/', $name);
                $users->picture='/images/profile/'.$name;
            }
            
            $users->save();

            $response = $this->generateItem($users);

            return $this->sendResponse($response, 201);
        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //Delete user
    {
        try {

            $users=User::find($id);
            $users->profile()->delete();
            $users->delete();
            return response()->json('Success',201);

        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }

    }

    public function changerole($id) //Change Role
    {
        try {
            $users=User::find($id);
            if($users->role == 1){
                $users->role = 2;
            }
            else{
                $users->role = 1;
            }
            $users->save();
            $response = $this->generateItem($users);
            return response()->json($response,200);

        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }

    }

    public function getuserbylogin($username)
    {
        // return response($username);
        try {
            $users = User::where('username',$username)->first();
            if($users == null)
            {
                return;
            }
            return response()->json($users);
            // $response = $this->generateItem($users);
            // return response()->json($response,200);

        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
    }

    public function emailverification($verifycode)
    {
        $users = User::where('verifycode',$verifycode)->first();

        if($users)
        {
            $users->status = 1;
            $users->save();
            return redirect()->route('/verify');
        }
        echo "Success";
        return null;
    }
}
