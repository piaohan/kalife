<?php

use Illuminate\Database\Seeder;
use App\MarkupValueType;

class MarkupValueTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $markups = [
          [
              'id' => 0,
              'type' => 'Percentage'
          ],

          [
              'id' => 1,
              'type' => 'Naira'
          ],
      ];

      foreach ($markups as $key => $value)
      {
        MarkupValueType::create($value);
      }
    }
}
