<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\EventTransformers;
use App\Event;

class EventController extends RestController
{
    protected $transformer = EventTransformers::Class;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //Get all event
    {
        $events= Event::All();
        $response = $this->generateCollection($events);
        return $this->sendResponse($response, 201); 
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
    public function store(Request $request) //Add Event
    {
        // return response($request);
        $this->validate($request, [
            'title'         => 'required|unique:events',
            'type'          => 'required',
            'place'         => 'required',
            // 'image'         => 'required',
            'description'   => 'required',

            'date_start'    => 'required',
            'date_end'      => 'required',                
            'time_start'    => 'required',
            'time_end'      => 'required',

            // 'highlight'     => 'required',
            // 'verify'        => 'required',
            'id_user'       => 'required',
        ]);
        
        try{

            $created = Event::create([
                'title'         => $request->title,
                'type'          => $request->type,
                'place'         => $request->place,
                'image'         => " ",
                'description'   => $request->description,

                'date_start'    => $request->date_start,
                'date_end'      => $request->date_end,                
                'time_start'    => $request->time_start,
                'time_end'      => $request->time_end,

                'highlight'     => 0,
                'verify'        => 0,
                'id_user'       => $request->id_user,
            ]);

            if($request->hasfile('image'))
            {
                $file = $request->file('image');
                $name=$created->type.$created->id.".jpg";
                $file->move(public_path().'/images/event/', $name);
                $created->image='/images/event/'.$name;
            }
            
            $created->save();

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
    public function show($id) //Get event by id
    {
        try{
          
            $events = Event::find($id);

            $response = $this->generateItem($events);
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
        $this->validate($request, [
            'title'         => 'required',
            'type'          => 'required',
            'place'         => 'required',
            'image'         => 'required',
            'description'   => 'required',

            'date_start'    => 'required',
            'date_end'      => 'required',                
            'time_start'    => 'required',
            'time_end'      => 'required',

            // 'highlight'     => 'required',
            // 'verify'        => 'required',
            'id_user'       => 'required',
        ]);
        try{

            $events = Event::find($id)->update($request->All());
            $data = Event::find($id);
            $response = $this->generateItem($data);
            return $this->sendResponse($response, 201);


        }catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
    }

    public function changeHighlight($id) //Change Highlight status
    {
        try{    
            $events=Event::find($id);

            if($events->highlight == 0){
                $events->highlight = 1;
            }else{
                $events->highlight = 0;
            }
            $events->save();
            
            $response = $this->generateItem($events);
            return $this->sendResponse($response, 200);

        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
    }

    public function eventverify($id) //Change Highlight status
    {
        try{    
            $events=Event::find($id);

            if($events->verify == 0){
                $events->verify = 1;
            }else{
                $events->verify = 0;
            }
            $events->save();
            
            $response = $this->generateItem($events);
            return $this->sendResponse($response, 200);

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
    public function destroy($id) //Delete event
    {
        try{
            
            $events=Event::find($id)->delete();

            return response()->json('success',200);
        
        } catch (\Exception $e) {
            return $this->sendIseResponse($e->getMessage());
        }
       
    }
}
