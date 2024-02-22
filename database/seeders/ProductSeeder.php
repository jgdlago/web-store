<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'Café (1 KG)',
                'product_code' => 'AL1',
                'description' => 'Café em grãos, 1 KG',
                'price' => 1090, // R$ 10,90
                'unit_of_measurement' => 'KG',
            ],
            [
                'name' => 'Energético (473ml)',
                'product_code' => 'BD1',
                'description' => 'Bebida energética, 473ml',
                'price' => 799, // R$ 7,99
                'unit_of_measurement' => 'ml',
            ],
            [
                'name' => 'Conjunto de Potes (4 un)',
                'product_code' => 'UT1',
                'description' => 'Conjunto com 4 potes de plástico',
                'price' => 2570, // R$ 25,70
                'unit_of_measurement' => 'UN',
            ],
            [
                'name' => 'Molho de Tomate (500 gr)',
                'product_code' => 'AL2',
                'description' => 'Molho de tomate tradicional, 500 gr',
                'price' => 650, // R$ 6,50
                'unit_of_measurement' => 'GR',
            ],
            [
                'name' => 'Biscoito Recheado (1 un)',
                'product_code' => 'AL3',
                'description' => 'Biscoito recheado, 1 unidade',
                'price' => 290, // R$ 2,90
                'unit_of_measurement' => 'UN',
            ],
            [
                'name' => 'Amaciante (2l)',
                'product_code' => 'LP1',
                'description' => 'Amaciante de roupas, 2 litros',
                'price' => 649, // R$ 6,49
                'unit_of_measurement' => 'LT',
            ],
            [
                'name' => 'Vinho (750ml)',
                'product_code' => 'BD2',
                'description' => 'Vinho tinto, 750ml',
                'price' => 2190, // R$ 21,90
                'unit_of_measurement' => 'ml',
            ],
            [
                'name' => 'Creme Dental (1 un)',
                'product_code' => 'HG1',
                'description' => 'Creme dental, 1 unidade',
                'price' => 1190, // R$ 11,90
                'unit_of_measurement' => 'UN',
            ],
            [
                'name' => 'Desinfetante (500 ml)',
                'product_code' => 'LP2',
                'description' => 'Desinfetante para limpeza, 500ml',
                'price' => 315, // R$ 3,15
                'unit_of_measurement' => 'ml',
            ],
            [
                'name' => 'Suco Uva (450 ml)',
                'product_code' => 'BD3',
                'description' => 'Suco de uva integral, 450ml',
                'price' => 419, // R$ 4,19
                'unit_of_measurement' => 'ml',
            ],
            [
                'name' => 'Massa Penne (500 gr)',
                'product_code' => 'AL4',
                'description' => 'Massa tipo Penne, 500 gr',
                'price' => 357, // R$ 3,57
                'unit_of_measurement' => 'GR',
            ],
            [
                'name' => 'Papel Higiênico (4 rolos)',
                'product_code' => 'HG2',
                'description' => 'Papel higiênico, pacote com 4 rolos',
                'price' => 765, // R$ 7,65
                'unit_of_measurement' => 'UN',
            ],
            [
                'name' => 'Creme de leite (200g)',
                'product_code' => 'AL5',
                'description' => 'Creme de leite, 200g',
                'price' => 325, // R$ 3,25
                'unit_of_measurement' => 'GR',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
