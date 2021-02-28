<?php

namespace App\Repositories;

use App\Helpers\ImageHelper;
use App\Models\Media;

class MediaRepository implements MediaRepositoryInterface
{
    public function save($data, $type)
    {
        $payload = [
            'type' => $type,
            'name' => $data['name'],
            'provider_id' => $data['provider'],
        ];

        $newFile = null;
        switch ($type) {
            case 'image':
                $newFile = $this->upload($data->file('image_file'));
                break;
            case 'video':
                $newFile = $this->upload($data->file('video_file'));

                $thumbnail = ImageHelper::generateThumbnail($newFile->getRealPath(), $data['name'] . '_thumb');
                $payload['thumbnail'] = $thumbnail;

                break;
        }

        $payload['path'] = $newFile->getPathname();

        return Media::create($payload);
    }

    private function upload($file)
    {
        return $file->move('upload', $file->getClientOriginalName());
    }
}
