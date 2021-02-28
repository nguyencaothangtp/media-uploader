<?php

namespace Database\Seeders;

use App\Models\Provider;
use Illuminate\Database\Seeder;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Provider::create([
            'name' => 'Google',
            'media_rules' => json_encode(
                [
                    'image' => [
                        'extension' => 'jpg',
                        'rules' => [
                            [
                                'name' => 'size',
                                'operator' => '<',
                                'value' => 2, // in bytes
                                'description' => 'Image size must be smaller than 2mb'
                            ],
                            [
                                'name' => 'ratio',
                                'operator' => '==',
                                'value' => '4:3',
                                'description' => 'Image ratio must be 4:3'
                            ]
                        ],
                    ],
                ]
            )
        ]);

        Provider::create([
            'name' => 'Snapchat',
            'media_rules' => json_encode(
                [
                    'image' => [
                        'extension' => 'jpg,gif',
                        'rules' => [
                            [
                                'name' => 'size',
                                'operator' => '<',
                                'value' => 5000000, // in bytes
                                'description' => 'Image size must be smaller than 5mb'
                            ],
                            [
                                'name' => 'ratio',
                                'operator' => '==',
                                'value' => '16:9',
                                'description' => 'Image ratio must be 16:9'
                            ]
                        ],
                    ]
                ]
            )
        ]);
    }
}
