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
        // Seed Provider data. The media_rules of each provider are not hard-corded. It will be dynamically stored in
        // json in db so that it is extendable and scalable

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
                                'value' => 2097152, // in bytes
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
                                'value' => 5242880, // in bytes
                                'description' => 'Image size must be smaller than 5mb'
                            ],
                            [
                                'name' => 'ratio',
                                'operator' => '==',
                                'value' => '16:9',
                                'description' => 'Image ratio must be 16:9'
                            ]
                        ],
                    ],
                    'video' => [
                        'extension' => 'mp4,mov',
                        'rules' => [
                            [
                                'name' => 'size',
                                'operator' => '<',
                                'value' => 52428800, // in bytes
                                'description' => 'Video size must be smaller than 50mb'
                            ],
                            [
                                'name' => 'duration',
                                'operator' => '<',
                                'value' => '300',
                                'description' => 'Video duration must be smaller than 5 minutes'
                            ]
                        ],
                    ],
                ]
            )
        ]);
    }
}
