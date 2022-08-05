<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private $dummyWebsites = [
        ["Facebook","http://facebook.com"],
        ["Google","http://google.com"],
        ["youtube","http://youtube.com"],
        ["gmail","http://gmail.com"],
        ["pin","http://pin.com"],
        ["dysinb","http://dysinb.com"],
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function run()
    {
        \App\Models\User::factory(50)->create();
        foreach($this->dummyWebsites as $site){
            \App\Models\WebSite::create([
                "name"=> $site[0],
                "url" => $site[1],
                "owner" => \App\Models\User::inRandomOrder()->first()->id,
            ]);

        }
    }
}
