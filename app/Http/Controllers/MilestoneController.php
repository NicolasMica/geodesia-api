<?php

namespace App\Http\Controllers;

use App\Milestone;
use Illuminate\Http\Request;

class MilestoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $attributes = $request->only('lib_rte');

        return Milestone::where($attributes)->get();
    }

}
