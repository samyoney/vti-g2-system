<?php

namespace App\Services\Media;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaService
{
    /**
     * Handles a file upload to the storage
     *
     *
     * @return Media
     *
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function replace(UploadedFile $file, User $user, $collection)
    {
        $media = $user->getMedia($collection);
        foreach ($media as $media_item) {
            $media_item->delete();
        }

        return $this->store($file, $user, $collection);
    }

    /**
     * Handles a file upload to the storage
     *
     *
     * @return Media
     *
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function store(UploadedFile $file, User $user, $collection)
    {
        return $user->addMedia($file)->toMediaCollection($collection);
    }
}
