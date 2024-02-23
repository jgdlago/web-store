<?php

namespace Database\Seeders;

use App\Models\Rule;
use App\Models\Promotion;
use Illuminate\Database\Seeder;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $promotions = [
            [
                'name' => 'Promoção biscoitos compre um ganhe outro',
                'product_code' => 'AL3',
                'rule_id' => Rule::where('name', 'Compre 1 ganhe outro')->first()->id,
            ],
            [
                'name' => 'Promoção conjunto de potes por R$: 21,70',
                'product_code' => 'UT1',
                'rule_id' => Rule::where('name', 'Mais de 1 un 21,70')->first()->id,
            ],
            [
                'name' => 'Promoção fardo de energético por R$: 7,50',
                'product_code' => 'BD1',
                'rule_id' => Rule::where('name', 'Compre 1 fardo 7,50 un')->first()->id,
            ],
            [
                'name' => 'Promoção vinho compre 3 ganhe 1',
                'product_code' => 'BD2',
                'rule_id' => Rule::where('name', 'Compre 3 ganhe 1')->first()->id,
            ],
            [
                'name' => 'Compre 4un suco de uva ganhe 10%',
                'product_code' => 'BD3',
                'rule_id' => Rule::where('name', 'Compre 4 ganhe 10%')->first()->id,
            ],
            [
                'name' => 'Compre 3un creme de leite R$: 3,00',
                'product_code' => 'AL5',
                'rule_id' => Rule::where('name', 'Compre 3 3,00')->first()->id,
            ]
        ];

        foreach ($promotions as $promotion) {
            Promotion::create($promotion);
        }
    }
}
