<?php

namespace App\Services\Image;

use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ImageService
{
    public function saveImage(array $data, string $subFolder, string $oldImage = null): array
    {
        if (isset($data[$subFolder])) {
            $poster = $data[$subFolder];
            $filename = random_int(10000000, 99999999).time().".".$poster->getClientOriginalExtension();
            $manager = new ImageManager(new Driver());
            $image = $manager->read($poster);
            $imagePath = '/uploads/' . $subFolder . '/'.$filename;
            $image->save(public_path($imagePath));
            $data[$subFolder] = $imagePath;
            if ($oldImage) {
                $this->deleteImage($oldImage);
            }
        }

        return $data;
    }

    public function deleteImage(string $imageUrl): void
    {
        $imageUrl = public_path($imageUrl);
        if (file_exists($imageUrl)) {
            unlink($imageUrl);
        }
    }
}
