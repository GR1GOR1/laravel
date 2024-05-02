<?php

namespace App\Http\Controllers\Public;

use App\Models\Car;
use App\Http\Controllers\Controller;

class Cars extends Controller
{
    public function index()
    {
        $cars = Car::ofActive()->get();
        //->where('status', Status::ACTIVE)
        //$cars = Car::with('brand.country', 'tags')->orderByDesc('created_at')->get();
        //dd(trans('alerts.cars.edited'));
        return view('public.cars.index', compact('cars'));
    }
}