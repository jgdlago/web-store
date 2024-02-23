<?php

namespace Database\Seeders;

use App\Models\Rule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rules = [
            [
              'name' => 'Compre 1 ganhe outro',
              'buy_quantity' => 1,
              'get_quantity' => 1
            ],
            [
                'name' => 'Mais de 1 un 21,70',
                'minimum_quantity' => 1,
                'promotion_price' => '21,70',
            ],
            [
                'name' => 'Compre 1 fardo 7,50 un',
                'minimum_quantity' => 6,
                'promotion_price' => '7,50'
            ],
            [
                'name' => 'Compre 3 ganhe 1',
                'buy_quantity' => 3,
                'get_quantity' => 1
            ],
            [
                'name' => 'Compre 4 ganhe 10%',
                'minimum_quantity' => 4,
                'discount_percentage' => 10
            ],
            [
                'name' => 'Compre 3 3,00',
                'minimum_quantity' => 3,
                'promotion_price' => '3,00'
            ]
        ];

        foreach ($rules as $rule) {
            Rule::create($rule);
        }
    }
}
