<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\Station;
use App\Models\Ticket;
use App\Models\Train;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function index(Request $request)
    {
        $routes = [];
        if ($request->get('station_from') && $request->get('station_to'))
        {
            $routes = Route::query()
                ->where('station_from_id', '=', $request->get('station_from'))
                ->where('station_to_id', '=', $request->get('station_to'))
                ->where('date_start', '>=', $request->get('date_start'))
                ->where('date_end', '<=', $request->get('date_end'))
                ->withSum('trains', 'max_seats_cnt')
                ->get();
        }
        else
        {
            $routes = Route::query()
                ->withSum('trains', 'max_seats_cnt')
                ->get();
        }

        $stations = Station::all();
        return view('route.list', [
            'stations' => $stations,
            'routes' => $routes,
            'searchValues' => [
                'station_from' => $request->get('station_from'),
                'station_to' => $request->get('station_to'),
                'date_start' => $request->get('date_start'),
                'date_end' => $request->get('date_end'),
            ],
            'isSearchStart' => $request->get('q') == 'y'
        ]);
    }

    public function buyTicket(int $routeId, Request $request)
    {
        $route = Route::query()
            ->where('id', '=', $routeId)
            ->withSum('trains', 'max_seats_cnt')
            ->first();

        $currentDate = Carbon::now();
        $dateStart = Carbon::createFromTimeString($route->date_start);

        $hasErrors = false;
        if ($request->isMethod('POST'))
        {
            $validator = \Validator::make($request->all(), [
                'cnt' => 'required|min:1',
            ]);
            $hasErrors = $validator->fails();
            if ($request->get('cnt') > $route->trains_sum_max_seats_cnt - $route->tickets->count())
            {
                $hasErrors = true;
            }
            if (!$hasErrors)
            {
                for ($i = 0; $i < $request->get('cnt'); $i++)
                {
                    $ticket = new Ticket();
                    $ticket->is_paid = false;
                    $ticket->user()->associate(auth()->user());
                    $ticket->route()->associate($route);
                    $ticket->save();
                }
                $route = Route::query()
                    ->where('id', '=', $routeId)
                    ->withSum('trains', 'max_seats_cnt')
                    ->first();
            }
        }

        return view('route.buy_ticket', [
            'route' => $route,
            'canBuy' => $currentDate->timestamp <= $dateStart->timestamp,
            'hasErrors' => $hasErrors,
            'isFormSubmitted' => $request->isMethod('POST'),
        ]);
    }
}
