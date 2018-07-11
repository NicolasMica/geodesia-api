<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $roadwork - Roadwork Primary Key (id)
     * @param  $marker - Marker Primary Key (id)
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $roadwork, $marker)
    {
        return Photo::where('marker_id', $marker)
            ->get();
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

        return Photo::create($attributes);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $roadwork - Roadwork Primary Key (id)
     * @param  $marker - Marker Primary Key (id)
     * @param  $photo - Photo Primary Key (id)
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $roadwork, $marker, $photo)
    {
        return Photo::where('id', $photo)
            ->where('marker_id', $marker)
            ->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $roadwork - Roadwork Primary Key (id)
     * @param  $marker - Marker Primary Key (id)
     * @param  $photo - Photo Primary Key (id)
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $roadwork, $marker, $photo)
    {
        $attributes = $this->validateAttributes($request);

        $photoToUpdate = Photo::where('marker_id', $marker)
            ->where('id', $photo)
            ->firstOrFail();
            
        $photoToUpdate->update($attributes);

        return $photoToUpdate;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $roadwork - Roadwork Primary Key (id)
     * @param  $marker - Marker Primary Key (id)
     * @param  $photo - Photo Primary Key (id)
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $roadwork, $marker, $photo)
    {
        Photo::where('marker_id', $marker)
            ->where('id', $photo)
            ->delete();
    }

    /**
     * Validate request attributes
     *
     * @param  \Illuminate\Http\Request  $request
     */
    protected function validateAttributes(Request $request){
        return $request->validate([
            'path' => 'required',
            'description' => 'nullable'
        ]);
    }
}
