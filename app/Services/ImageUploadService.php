<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use InvalidArgumentException;

class ImageUploadService
{
    public function uploadImage(UploadedFile $file)
    { 
        if (!$this->isImageValid($file)) {
            throw new InvalidArgumentException('Invalid file.');
        }
 
        $filename = 'vehicle_images/' . uniqid() . '_' . $file->getClientOriginalName();
 
        Storage::disk('public')->put($filename, file_get_contents($file));
 
        $path = Storage::url($filename);
        
        return $path;
    }

    private function isImageValid(UploadedFile $file)
    {
        $allowedMimeTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
         
        if (!in_array($file->getMimeType(), $allowedMimeTypes)) {
            return false;
        }

        return true;
    }
}
