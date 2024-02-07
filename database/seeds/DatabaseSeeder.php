<?php

use App\Content;
use App\Granters;
use App\Kids;
use App\User;
use Illuminate\Database\Seeder;
use Faker\Generator;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{

    public $faker;
    
    function __construct(Generator $faker)
    {
        $this->faker = $faker;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (count(User::all()) == 0) {
            $this->command->info('No records found. Beginning Seeder');

            try {

                factory(User::class, 3)->create();
                $content = new Content();
                $content->content = "This is the content";
                $content->save();

                factory(Granters::class, 3)->create();
                factory(Kids::class, 4)->create();

                $this->command->info('Seeder Completed');
            } catch (\Throwable $th) {
                $this->command->info('Error with seeder');
                throw $th;
            }
        } else {
            $this->command->info('Records found. Skipping Seeder');
        }
    }
}
