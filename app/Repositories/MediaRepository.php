<?php

namespace App\Repositories;

use App\Models\Media;

class MediaRepository implements MediaRepositoryInterface
{
    public function save($data)
    {
        $newFile = $this->upload($data->file('image_file'));

        return Media::create([
            'type' => 'image',
            'name' => $data['name'],
            'provider_id' => $data['provider'],
            'path' => $newFile->getPathname()
        ]);
    }

    private function upload($file)
    {
        return $file->move('upload', $file->getClientOriginalName());
    }
}
