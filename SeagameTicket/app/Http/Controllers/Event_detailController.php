<?php

namespace App\Http\Controllers;

use App\Models\Event_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class Event_detailController extends Controller
{
    // get all events detail from event detail table 
    public function index()
    {
        $eventDetail  = Event_detail::all();
        return response()->json(['success' => true , 'data' => $eventDetail],200);
    }

    // create event detail to event detail table
    public function store(Request $request)
    {
        //validation
        $validator = Validator::make(
            $request->all(),
            [
                'compitation' => 'required|min:5|max:30',
                'time' => 'required|date_format:H:i',
            ]
        );
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            $event_detail = Event_detail::create([
                'compitation' => $request['compitation'],
                'time' => $request['time'],
            ]);
            return response()->json(['success' => true, 'data' => $event_detail], 201);
        }

    }

    //show event detail by givent id of event detail
    public function show(string $id)
    {
        $event_detail = Event_detail::find($id);
        return response()->json(['success' => true, 'data' => $event_detail], 201);
    }

    //update event detail by given event detail id 
    public function update(Request $request, string $id)
    {
        //validation
        $validator = Validator::make(
            $request->all(),
            [
                'compitation' => 'required|min:5|max:30',
                'time' => 'required|date_format:H:i',
            ]
        );
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            $event_detail = Event_detail::where('id',$id)->update([
                'compitation' => $request['compitation'],
                'time' => $request['time'],
            ]);
            return response()->json(['success' => true, 'data' => $event_detail], 200);
        }
    }
    
    // delete event detail by id
    public function destroy(string $id)
    {
        $event_detail = Event_detail::destroy($id);
        return response()->json(['message' => "You have been deleted event detail on id ".$id, 'data' => $event_detail], 200);

    }
}
