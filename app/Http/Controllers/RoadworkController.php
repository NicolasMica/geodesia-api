<?php

namespace App\Http\Controllers;

use App\Roadwork;
use App\User;
use Illuminate\Http\Request;

class RoadworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Roadwork[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return Roadwork::with('markers.photos')->get();
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

        return Roadwork::create($attributes);
    }

    /**
     * Display the specified resource.
     *
     * @param  $roadwork - Roadwork Primary Key (id)
     * @return Roadwork|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
     */
    public function show($roadwork)
    {
        return Roadwork::with('markers.photos')
            ->where('id', $roadwork)
            ->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  $roadwork - Roadwork Primary Key (id)
     * @return Roadwork|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function update(Request $request, $roadwork)
    {
        $attributes = $this->validateAttributes($request);

        $roadworkToUpdate = Roadwork::with('markers.photos')
            ->where('id', $roadwork)
            ->firstOrFail();

        $roadworkToUpdate->update($attributes);

        return $roadworkToUpdate;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $roadwork - Roadwork Primary Key (id)
     * @return void
     */
    public function destroy($roadwork)
    {
        Roadwork::with('markers.photos')
            ->where('id', $roadwork)
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
            'name'        => 'required',
            'description' => 'nullable',
            'from_lat'    => 'required|numeric',
            'from_long'   => 'required|numeric',
            'to_lat'      => 'required|numeric',
            'to_long'     => 'required|numeric',
            'referent'    => 'required',
            'department'  => 'required'
        ]);
    }
}
