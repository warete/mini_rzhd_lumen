<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\Station;
use App\Models\Train;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function show(Request $request)
    {
        $stations = Station::all();

        $trains = Train::all();

        return view('admin.route.new', [
            'stations' => $stations,
            'trains' => $trains,
            'hasErrors' => $request->get('success') == 'n',
        ]);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'station_from' => 'required|min:1',
            'station_to' => 'required|min:1',
            'date_start' => 'required|min:1',
            'date_end' => 'required|min:1',
            'trains' => 'required|min:1',
            'price' => 'required|min:1'
        ]);
        if ($validator->fails() || $request->get('station_from') == $request->get('station_to'))
        {
            return redirect()->route('admin_route_new', ['success' => 'n']);
        }
        $route = new Route();
        $route->stationFrom()->associate(Station::findOrFail($request->get('station_from')));
        $route->stationTo()->associate(Station::findOrFail($request->get('station_to')));
        $route->price = $request->get('price');
        $route->date_start = Carbon::parse($request->get('date_start'));
        $route->date_end = Carbon::parse($request->get('date_end'));
        $route->save();
        $route->trains()->attach($request->get('trains'));
        if ($route->save())
        {
            return view('admin.route.new', [
                'route' => $route,
            ]);
        }
        else
        {
            return redirect()->route('admin_route_new')->with('success', 'n');
        }
    }
}
