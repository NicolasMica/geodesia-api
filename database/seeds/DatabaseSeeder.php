<?php

use App\Roadwork;
use App\Marker;
use App\Photo;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $roadworks = factory(Roadwork::class, 5)->create();

        foreach($roadworks as $r){

            $markers = factory(Marker::class, rand(0, 10))->create([
                'roadwork_id' => $r->id,
                'user_id' => $r->user_id
            ]);

            foreach($markers as $m){
                factory(Photo::class, rand(0, 10))->create([
                    'marker_id' => $m->id
                ]);
            }

        }
        
    }
}
