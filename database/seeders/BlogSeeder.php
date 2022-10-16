<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    //php artisan db:seed --class="BlogSeeder" 

    public function run()
    {
        //
        $x = 1;
        for ($i = 1; $i < 100000; $i++) {

            $start = strtotime("2021-01-01 00:00:00");

            $end =  strtotime("2022-10-16 23:59:59");

            $randomDate = date("Y-m-d H:i:s", rand($start, $end));

            $title = 'How to Configure Nginx and Apache on the same Ubuntu VPS or Dedicated Server'. $this->random_str(10, 'abcdefghijklmnopqrstuvwxyz');
            $route = Str::slug($title);

            DB::table('blogs')->insert([
                'id' => $x++,
                'title' => $title,
                'route' => $route,
                'file' => 'jaguar-634bbccb20999.jpg',
                'description' => $this->random_str(5000, 'abcdefghijklmnopqrstuvwxyz'),
                'created_by' => rand(1, 3),
                'created_at' => $randomDate,
                'updated_at' => $randomDate,
            ]);
        }
    }

    //Usage:

    // $a = random_str(32);
    // $b = random_str(8, 'abcdefghijklmnopqrstuvwxyz');
    // $c = random_str();

    public function random_str(
        int $length = 64,
        string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
    ): string {
        if ($length < 1) {
            throw new \RangeException("Length must be a positive integer");
        }
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces[] = $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }
}
