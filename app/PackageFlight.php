<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageFlight extends Model
{
    protected $fillable = ['package_id', 'from_location','to_location','airline','departure_date_time'];

    public function package()
    {
        //
    }

    public static function store($request)
    {
        for($i = 0; $i < count($request->from_location); $i++)
        {
            $flight = [
                'package_id' => $request->package_id,
                'from_location' => $request->from_location[$i],
                'to_location' => $request->to_location[$i],
                'airline' => $request->airline[$i],
                'departure_date_time' => $request->departure_date_time[$i],
                'arrival_date_time' => $request->arrival_date_time[$i],
                'cabin' => $request->cabin[$i],
            ];
            static::create($flight);
        }
    }

    public static function getFlightsByPackageId($id){
        return static::where('package_id',$id)->get();
    }

}
