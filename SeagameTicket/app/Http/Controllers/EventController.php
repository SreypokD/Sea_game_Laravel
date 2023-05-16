<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class EventController extends Controller
{
    public function index()
    {
        //get all events 
        $events = Event::all();
        // search for events with sport name
        $events = Event::where('sportName' ,'like', '%'. request('sportName') . '%')->get();
        // search for events with schedule
        $events = Event::where('schedule', 'like', '%'. request('schedule') . '%')->get();
        return response()->json(['success' => true, 'data' => $events],200);
    }
    
    //create event by to events table 
    public function store(Request $request)
    {
        //validation
        $validator = Validator::make(
            $request->all(),
            [
                'sportName' => 'required|max:30',
                'typePlayer' => 'required|max:10',
                'schedule' => 'required|date_format:Y-m-d H:i:s|after_or_equal:today',
            ]
        );
        if ($validator->fails()) {
            return $validator->errors();
        }else{
            $events = Event::create([
                'sportName' => $request['sportName'],
                'typePlayer' => $request['typePlayer'],
                'schedule' => $request['schedule'],
                'stadium_id' => $request['stadium_id'],
                'event_detail_id' => $request['event_detail_id'],
            ]);
            return response()->json(['success' => true, 'data' => $events],201);
        }
    }
    
    //show event by input id  
    public function show(string $id)
    {
        //  
        $events = Event::find($id);
        return response()->json(['success' => true, 'data' => $events],200);   

    }
    // update event 
    public function update(Request $request, string $id)
    {
        // //validation
        $validator = Validator::make(
            $request->all(),
            [
                'sportName' => 'required|max:30',
                'typePlayer' => 'required|max:10',
                'schedule' => 'required',
            ]
        );
        if ($validator->fails()) {
            return $validator->errors();
        }else{
            $events = Event::where('id',$id)->update([
                'sportName' => $request['sportName'],
                'typePlayer' => $request['typePlayer'],
                'schedule' => $request['schedule'],
                'stadium_id' => $request['stadium_id'],
                'event_detail_id' => $request['event_detail_id'],
            ]);
            return response()->json(['success' => true, 'data' => $events],200);
        }
    }
    
    //delete event by given id 
    public function destroy(string $id)
    {
        $events = Event::destroy($id); 
        return response()->json(['message' => 'Delete successfully on id '.$id , 'data' => $events],200);
    }
}
