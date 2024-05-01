<?php

namespace App\Http\Controllers;

use App\Enums\Cars\Status;
use App\Http\Requests\Cars\Store as StoreRequest;
use App\Http\Requests\Cars\Update as UpdateRequest;
use Illuminate\Http\Request;

use App\Models\Car;
use App\Models\Brand;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class Cars extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::ofActive()->get();
        //->where('status', Status::ACTIVE)
        //$cars = Car::with('brand.country', 'tags')->orderByDesc('created_at')->get();
        //dd(trans('alerts.cars.edited'));
        return view('cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $transmissions = config('app-cars.transmissions');
        $brands = Brand::orderBy('title')->pluck('title', 'id');
        $tags  = Tag::orderBy('title')->pluck('title', 'id');
        return view('cars.create', compact('transmissions', 'brands', 'tags'));
    }

    public function store(StoreRequest $request)
    {

        //$car = Car::create($request->validated());  // или через only
        $data = collect($request->validated());
        $car = Car::make($data->except(['tags'])->toArray());
        // Теперь если будет ошибка при транзкции в БД, то мы ее увидим
        DB::transaction(function() use ($data, $car) {
            $car->save();
            $car->tags()->sync($data->get('tags'));
        });

        return redirect()->route('cars.show', [ $car->id ]);
    }

    public function show(Car $car)
    {
        // dd($car->status->text());
        return view('cars.show', compact('car'));
    }


    //public function edit(string $id)
    public function edit(Car $car)
    {
        //$car = Car::findOrFail($id);
        $transmissions = config('app-cars.transmissions');
        $brands = Brand::orderBy('title')->pluck('title', 'id');
        $tags  = Tag::orderBy('title')->pluck('title', 'id');
        return view('cars.edit', compact('car', 'transmissions', 'brands', 'tags'));
    }

    public function update(UpdateRequest $request, Car $car)
    {
        //$car->update($request->validated());
        $data = collect($request->validated());
        $car->update($data->except(['tags'])->toArray());
        $car->tags()->sync($data->get('tags'));
        return redirect()->route('cars.show', [ $car->id ])->with('alert', trans('alerts.cars.edited'));
    }

    public function destroy(Car $car)
    {
        // dd($car->canDelete); Для просмотра заданного атрибута
        // if($car->status === Status::DRAFT || $car->status === Status::CANCELED){
        if ($car->canDelete) {
            $car->delete();
            return redirect()->route('cars.index')->with('alert', trans('alerts.cars.deleted'));    
        }

        return redirect()->route('cars.show', [ $car->id ])->with('alert', trans('cant remove'));  
    }

    public function trashed() {
        $cars = Car::onlyTrashed()->orderByDesc('created_at')->get();
        return view('cars.trashed', compact('cars'));
    }

    // Так работать не будет, т.к. машина уже удалена! public function restore(Car $car) {
    public function restore(string $id) {
        $car = Car::onlyTrashed()->findOrFail($id);
        //dd($car);

        // лучше exists dd(Car::where('vin', $car->vin)->count());
        // Car::where('vin', $car->vin)->exists();
        if (Car::where('vin', $car->vin)->exists()) {
            return redirect()->route('cars.trashed')->with('alert', trans('alerts.cars.restore-fail-vin', ['vin' => $car->vin]));
        }
        $car->restore();
        return redirect()->route('cars.index')->with('alert', trans('alerts.cars.restored'));
    }
}
