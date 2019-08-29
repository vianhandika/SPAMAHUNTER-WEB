<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\UserProfileTransformers;
use App\UserProfile;

class UserProfileController extends RestController
{
    protected $transformer = UserProfileTransformers::Class;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = UserProfile::get();
        
        return response()->json($profile);
        // $response = $this->gernateCollection($profile);
        // return $this->sendResponse($profile,201);

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
        try {
            
            $created = UserProfile::create([
                'firstname'     => "-",
                'lastname'      => "-",
                'phone'         => "-",
                'jobstatus'     => "-",
                'jobplace'      => "-",
                'publicinfo'    => "-",
                'id_user'       => $request->id_user,
            ]);

            $response = $this->generateItem($created);
            return $this->sendResponse($response, 201);            

        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
            // return response()->json(['Failed To Register'=>'Failed'], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            
            $profile = UserProfile::find($id);
            
            $response = $this->generateItem($profile);
            return $this->sendResponse($response, 201);

        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
    }

    public function getbyuser($id)
    {
        // return response($id);
        try{
            
            $profile = UserProfile::where('id_user',$id)->first();
            // return response()->json($profile);
            $response = $this->generateItem($profile);
            return $this->sendResponse($response, 201);

        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
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
        try{
            
            // $profile = UserProfile::find($id)->update($request->All());
            $profile = UserProfile::find($id);
            $profile->firstname = $request->firstname;
            $profile->lastname = $request->lastname;
            $profile->phone = $request->phone;
            $profile->jobstatus = $request->jobstatus;
            $profile->jobplace = $request->jobplace;
            $profile->publicinfo = $request->publicinfo;
            $profile->save();
            $data = UserProfile::find($id);
            $response = $this->generateItem($data);
            return $this->sendResponse($response, 201);


        }catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
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
}
