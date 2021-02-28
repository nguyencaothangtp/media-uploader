<?php

namespace App\Http\Controllers;

use App\Http\Resources\MediaResource;
use Illuminate\Http\Request;
use App\Http\Requests\ImageRequest;
use App\Repositories\MediaRepositoryInterface;

class UploadController extends Controller
{
    protected $mediaRepository;
    public function __construct(Request $request, MediaRepositoryInterface $mediaRepository)
    {
        $this->mediaRepository = $mediaRepository;
        parent::__construct($request);
    }

    public function image(ImageRequest $request)
    {
        $media = $this->mediaRepository->save($request);
        return new MediaResource($media);
    }
}
