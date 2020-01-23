<?php

namespace App\Services;

use App;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ExtraService
{
    /**
     * Resize image
     *
     * @param $data
     * @param $sizeInfo
     * @return string
     */
    public function resize($data, $sizeInfo)
    {
        $storageDirName = 'storage';
        $image = Image::make(public_path($storageDirName . '/' . $data['file_name']));
        $resize = $image->resize($sizeInfo['width'], null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $resizedFileName = $storageDirName . '/' . $sizeInfo['name'] . $data['file_name'];
        $resize->save($resizedFileName);
        return $sizeInfo['name'] . $data['file_name'];
    }

    /**
     * Upload an image to AWS S3
     * @param arary $data
     * @return string url
     */
    public function uploadImage($data)
    {
        $image = $data['image_path'];
        $extension = $data['extension'];
        $filename = uniqid() . '.' . $extension;
        $filetype = $extension;

        $s3 = App::make('aws')->createClient('s3');
        $bucket = 'combibmark';
        $result = $s3->putObject([
            'Bucket' => $bucket,
            'Key' => $data['type'] . '/' . $filename,
            'Body' => file_get_contents($image),
            'ContentType' => 'image/' . $filetype,
            'ACL' => 'public-read'
        ]);
        $image = Image::make($image);
        Storage::disk('public')->delete($data['image_path']);
        return ['url' => $result['ObjectURL'], 'sizes' => [
            'width' => $image->width(),
            'height' => $image->height(),
        ]];
    }

    /**
     * Upload a design file to AWS S3
     * @param arary $data
     * @return string url
     */
    public function uploadDesignFile($data)
    {
        $file = $data['file'];
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();

        $s3 = App::make('aws')->createClient('s3');
        $bucket = 'combibmark';
        $result = $s3->putObject([
            'Bucket' => $bucket,
            'Key' => 'design/' . $filename,
            'Body' => file_get_contents($file),
            'ACL' => 'public-read'
        ]);

        return $result['ObjectURL'];
    }
}
