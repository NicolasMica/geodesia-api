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
        $attributes = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'geometry' => 'required',
            'referent' => 'required',
            'department' => 'required'
        ]);

        $attributes['user_id'] = $request->user()->id;

        return Roadwork::create($attributes);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Roadwork  $roadwork
     * @return \Illuminate\Http\Response
     */
    public function show(Roadwork $roadwork)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Roadwork  $roadwork
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Roadwork $roadwork)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Roadwork  $roadwork
     * @return \Illuminate\Http\Response
     */
    public function destroy(Roadwork $roadwork)
    {
        //
    }
}
