<?php

namespace App\Http\Controllers;

use App\Roadwork;
use Illuminate\Http\Request;

class RoadworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
        $attributes = $this->validateAttributes();

        $attributes['user_id'] = $request->user()->id;

        return Roadwork::create($attributes);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $roadwork - Roadwork Primary Key (id)
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $roadwork)
    {
        return Roadwork::with('markers.photos')
            ->where('id', $roadwork)
            ->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $roadwork - Roadwork Primary Key (id)
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $roadwork)
    {
        $attributes = $this->validateAttributes();

        return Roadwork::with('markers.photos')
            ->where('id', $roadwork)
            ->update([
                'name' => $attributes['name'],
                'description' => $attributes['description'],
                'geometry' => $attributes['geometry'],
                'referent' => $attributes['referent'],
                'department' => $attributes['department']
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $roadwork - Roadwork Primary Key (id)
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $roadwork)
    {
        Roadwork::with('markers.photos')
            ->where('id', $roadwork)
            ->delete();
    }

    /**
     * Validate request attributes
     *
     * @param  \Illuminate\Http\Request  $request
     */
    protected function validateAttributes(Request $request){
        return $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'geometry' => 'required',
            'referent' => 'required',
            'department' => 'required'
        ]);
    }
}
