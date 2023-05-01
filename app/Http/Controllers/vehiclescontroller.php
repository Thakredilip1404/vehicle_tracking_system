<?php

namespace App\Http\Controllers;

use App\Models\Vehicles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class vehiclescontroller extends Controller
{
    //
    public function index()
    {
        if(Auth::check())
        {
            $user_id =  Auth::user()->id;
            $vehicles = Vehicles::where('user_id',$user_id)->get();
            return response()->json(
                [
                    'status' => true,
                    'vehicles' => $vehicles 
                ]
            );
        }else
        {
            return response()->json(
                [
                    'status' => false
                ]
            );
        }
    }

    public function deletevehicles(Request $request)
    {
       if(!empty($request->id))
       {
        $user_id = Auth::user()->id;
            $status = Vehicles::where('id',$request->id)->where('user_id',$user_id)->delete();
            if($status)
            {
                return response()->json(
                    [
                        'status' => true
                    ]
                    );
            }else
            {
                return response()->json(
                    [
                        'status' => false
                    ]
                    );
            }
       }
    }

    public function addvehicles(Request $request)
    {
       if(!empty($request->vehicle_name))
       {
            $user_id = Auth::user()->id;
            if(isset($request->vehicle_id) && $request->vehicle_id != '')
            {
                $status = Vehicles::where('user_id', $user_id)
                ->where('id', $request->vehicle_id)
                ->update([
                    'vehicle_name' => $request->vehicle_name,
                    'vehicle_type' => $request->vehicle_type,
                    'year_of_manf' => $request->vehicle_yof,
                    'date_of_pruchase' => $request->vehicle_dop,
                 ]);
            }else
            {
                $status = Vehicles::insert([
                    'vehicle_name' => $request->vehicle_name,
                    'vehicle_type' => $request->vehicle_type,
                    'year_of_manf' => $request->vehicle_yof,
                    'date_of_pruchase' => $request->vehicle_dop,
                    'user_id' => $user_id
                 ]);
            }

            if($status)
            {
                $vehicles = Vehicles::where('user_id',$user_id)->get();
                return response()->json(
                    [
                        'status' => true,
                        'data' => $vehicles 
                    ]
                );
            }else
            {
                return response()->json(
                    [
                        'status' => false
                    ]
                    );
            }
       }
    }
}
