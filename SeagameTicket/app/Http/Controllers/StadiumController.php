<?php

namespace App\Http\Controllers;

use App\Models\Stadium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class StadiumController extends Controller
{
    // get all stadium from stadium table 
    public function index()
    {
        $stadiums = Stadium::all();
        return response()->json(['success' => true ,'data' => $stadiums],200);
    }

    // create stadium to stadium table
    public function store(Request $request)
    {
        //validation
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:3|max:15',
                'zone' => 'required|max:10',
            ]
        );
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            $stadiums = Stadium::create([
                'name' => $request['name'],
                'zone' => $request['zone'],
            ]);
            return response()->json(['success' => true, 'data' => $stadiums], 201);
        }
        
    }
    // show stadium by id 
    public function show( string $id)
    {
        $stadiums = Stadium::find($id);
        return response()->json(['success' => true, 'data' => $stadiums], 200);  
    }

    // update stadium by given stadium id 
    public function update(Request $request, string $id)
    {
              //validation
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:3|max:15',
                'zone' => 'required|max:10',
            ]
        );
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            $stadiums = Stadium::where('id' ,$id)->update([
                'name' => $request['name'],
                'zone' => $request['zone'],
            ]);
            return response()->json(['success' => true, 'data' => $stadiums], 201);
        }        
    }
    
    // delete staium by given staium id
    public function destroy(string $id)
    {
        $stadiums = Stadium::destroy($id);
        return response()->json(['message' => 'You have been deleted stadium on id '.$id, 'data' => $stadiums], 201);
    }
}
