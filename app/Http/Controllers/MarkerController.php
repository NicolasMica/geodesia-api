<?php

namespace App\Http\Controllers;

use App\Marker;
use App\Roadwork;
use App\User;
use Illuminate\Http\Request;

class MarkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $roadwork - Roadwork Primary Key (id)
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $roadwork)
    {
        return Marker::with('photos')->where('roadwork_id', $roadwork)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $this->validateAttributes($request);

//        $attributes['user_id'] = $request->user()->id;
        $attributes['user_id'] = User::inRandomOrder()->first()->id;

        return Marker::create($attributes);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $roadwork - Roadwork Primary Key (id)
     * @param  $marker - Marker Primary Key (id)
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $roadwork, $marker)
    {
        return Marker::with('photos')
            ->where('roadwork_id', $roadwork)
            ->where('id', $marker)
            ->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $roadwork - Roadwork Primary Key (id)
     * @param  $marker - Marker Primary Key (id)
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $roadwork, $marker)
    {
        $attributes = $this->validateAttributes($request);

        $markerToUpdate = Marker::with('photos')
            ->where('roadwork_id', $roadwork)
            ->where('id', $marker)
            ->firstOrFail();

        $markerToUpdate->update($attributes);

        return $markerToUpdate;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $roadwork - Roadwork Primary Key (id)
     * @param  $marker - Marker Primary Key (id)
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $roadwork, $marker)
    {
        Marker::with('photos')
            ->where('roadwork_id', $roadwork)
            ->where('id', $marker)
            ->delete();
    }

    /**
     * Validate request attributes
     *
     * @param  \Illuminate\Http\Request $request
     * @return
     */
    protected function validateAttributes(Request $request){
        return $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric'
        ]);
    }
}
