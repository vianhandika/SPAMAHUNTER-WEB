<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\EventCommentTransformers;
use App\EventComment;

class EventCommentController extends RestController
{
    protected $transformer = EventCommentTransformers::Class;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comment= EventComment::All();
        $response = $this->generateCollection($comment);
        return $this->sendResponse($response, 201); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{

            $created = EventComment::create([
                'username'      => $request->username,
                'userpict'      => $request->userpict,
                'comment'       => $request->comment,
                'id_event'      => $request->id_event,
                'id_user'       => $request->id_user,
            ]);

            $response = $this->generateItem($created);
            return $this->sendResponse($response, 201); 

        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
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
            $comment = EventComment::find($id);

            $response = $this->generateItem($comment);
            return $this->sendResponse($response, 201);      

        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
    }

    public function commentbyevent($id)
    {
        try{
            $comment = EventComment::where('id_event',$id)->get();

            $response = $this->generateCollection($comment);
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
        try{
            
            $comments=EventComment::find($id)->delete();

            return response()->json('success',200);
        
        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
    }
}
