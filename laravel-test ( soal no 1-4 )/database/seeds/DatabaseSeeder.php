<?php

use Illuminate\Database\Seeder;
use App\{
	Employee,
	Location 
};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	$dataLocation = [
    		[
    			"code" => "JKT",
    			"name" => "Jakarta"
    		],
    		[
    			"code" => "BDG",
    			"name" => "Bandung",
    		],
    		[
    			"code" => "SMG",
    			"name" => "Semarang"
    		],
    		[
    			"code" => "SRB",
    			"name" => "Surabaya"
    		]
    	];

    	foreach($dataLocation as $itemLocation){
    		Location::create($itemLocation);
    	}

    	$dataEmployee = [
    		[
    			"name" => "Lily Stark",
    			"location_code" => "JKT",
    			"birth_date" => "2000-12-31"
    		],
    		[
    			"name" => "Evan Roger",
    			"location_code" => "JKT",
    			"birth_date" => "1990-10-01"
    		],    		
    		[
    			"name" => "George Alvin",
    			"location_code" => "JKT",
    			"birth_date" => "1995-12-23"
    		],
    		[
    			"name" => "Logan Krolak",
    			"location_code" => "BDG",
    			"birth_date" => "1998-02-27"
    		],
    		[
    			"name" => "Scarlet Snow",
    			"location_code" => "SRB",
    			"birth_date" => "1996-06-05"
    		],
    		[
    			"name" => "Robert London",
    			"location_code" => "SMG",
    			"birth_date" => "1978-05-06"
    		]
    	];      

    	foreach($dataEmployee as $itemEmployee){
    		Employee::create($itemEmployee);
    	}
    }
}
