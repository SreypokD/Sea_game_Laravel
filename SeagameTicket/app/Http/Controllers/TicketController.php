<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class TicketController extends Controller
{

    //get all tickets from database
    public function index()
    {
        $allTicket = Ticket::all();
        return response()->json(['success' => true, 'data' => $allTicket],200);
    }
    
    // create ticket to database
    public function store(Request $request)
    {
        //validation
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:15',
                'event_id' => 'required|max:5',
                'description' => 'required|min:3|max:30',
            ]
        );
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            $tickets = Ticket::create([
                'name' => $request['name'],
                'event_id' => $request['event_id'],
                'description' => $request['description'],
            ]);
            return response()->json(['success' => true, 'data' => $tickets], 201);
        }
    }
    
    // buy the tickets by give event id 
    public function buyTicket(Request $request,string $id)
    {
        $result = 0;
        $buyTicket = Event::find($id)->tickets;
        $getEvent = $buyTicket->first()->event_id;
        for($i = 0; $i <count($buyTicket); $i++ ){
           $result+=1;
        }
        if($result <= 10){
            $newTicket =Ticket::create([
                'name' => "Sea Game 2023",
                'event_id' => $getEvent,
                'description' => "You have been bought ticket on event id ".$id,
            ]);
            return response()->json(['message' => 'You have been bought successfully !'. $id ,'data'=> $newTicket],200);
        }else{
            return response()->json(['message' => 'No ticket here ! ','data'=> "no data" ],200);
        }
    }

    // update tickets in database by id 
    public function update(Request $request, string $id)
    {
         //validation
         $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:30',
                'event_id' => 'required|max:5',
                'description' => 'required|min:3|max:30',
            ]
        );
        if ($validator->fails()) {
            return $validator->errors();
        }else{
            $tickets = Ticket::where('id' , $id)->update([
                'name' => $request['name'],
                'event_id' => $request['event_id'],
                'description' => $request['description'],
            ]);
            return response()->json(['success' => true, 'data' => $tickets],200);
        }
    }
    //delete tickets by givent id of tickets
    public function destroy(string $id)
    {
        $tickets = Ticket::destroy($id);
        return response()->json(['message' => "You has been delete ticket on id ".$id, 'data' => $tickets],200);
    }
}
