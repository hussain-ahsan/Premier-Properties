<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatesTableSeeder extends Seeder
{
    /**
     * Create an admin user in the database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->delete();
        $table = [
            [
                'state_name' => "Alabama",
                'state_code' => 'AL',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "Alaska",
                'state_code' => 'AK',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "Arizona",
                'state_code' => 'AZ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "Arkansas",
                'state_code' => 'AR',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "California",
                'state_code' => 'CA',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "Colorado",
                'state_code' => 'CO',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "Connecticut",
                'state_code' => 'CT',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "Delaware",
                'state_code' => 'DE',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "District Of Columbia",
                'state_code' => 'DC',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "Florida",
                'state_code' => 'FL',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "Georgia",
                'state_code' => 'GA',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "Hawaii",
                'state_code' => 'HI',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "Idaho",
                'state_code' => 'ID',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "Illinois",
                'state_code' => 'IL',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "Indiana",
                'state_code' => 'IN',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "Iowa",
                'state_code' => 'IA',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "Kansas",
                'state_code' => 'KS',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "Kentucky",
                'state_code' => 'KY',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "Louisiana",
                'state_code' => 'LA',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "Maine",
                'state_code' => 'ME',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "Maryland",
                'state_code' => 'MD',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "Massachusetts",
                'state_code' => 'MA',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "Michigan",
                'state_code' => 'MI',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "Minnesota",
                'state_code' => 'MN',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "Mississippi",
                'state_code' => 'MS',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "Missouri",
                'state_code' => 'MO',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "Montana",
                'state_code' => 'MT',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "Nebraska",
                'state_code' => 'NE',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "Nevada",
                'state_code' => 'NV',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "New Hampshire",
                'state_code' => 'NH',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "New Jersey",
                'state_code' => 'NJ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "New Mexico",
                'state_code' => 'NM',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "New York",
                'state_code' => 'NY',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "North Carolina",
                'state_code' => 'NC',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "North Dakota",
                'state_code' => 'ND',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "Ohio",
                'state_code' => 'OH',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "Oklahoma",
                'state_code' => 'OK',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "Oregon",
                'state_code' => 'OR',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "Pennsylvania",
                'state_code' => 'PA',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "Rhode Island",
                'state_code' => 'RI',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "South Carolina",
                'state_code' => 'SC',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "South Dakota",
                'state_code' => 'SD',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "Tennessee",
                'state_code' => 'TN',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "Texas",
                'state_code' => 'TX',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "Utah",
                'state_code' => 'UT',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "Vermont",
                'state_code' => 'VT',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "Virginia",
                'state_code' => 'VA',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "Washington",
                'state_code' => 'WA',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "West Virginia",
                'state_code' => 'WV',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "Wisconsin",
                'state_code' => 'WI',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'state_name' => "Wyoming",
                'state_code' => 'WY',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];
        DB::table('states')->insert($table);
    }
}
