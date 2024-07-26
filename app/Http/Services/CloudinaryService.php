<?php

namespace App\Http\Services;

use App\Enums\StatusCode;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CloudinaryService
{
    public function getFileUrl($publicId)
    {
        try {
            $url = Cloudinary::getUrl($publicId);

            return $url;
        } catch (\Exception $e) {
            Log::error('Error in ' . __METHOD__ . ': ' . $e->getMessage());

            return null;
        }
    }

    public function uploadFile(Request $request, $folder)
    {
        try {
            $file = $request->file('file');

            if (!$file) {
                return response()->json(['error' => 'No image file provided'], StatusCode::HTTP_BAD_REQUEST);
            }

            $uploadedFile = Cloudinary::upload($file->getRealPath(), [
                'folder' => $folder,
            ]);

            $publicId = $uploadedFile->getPublicId();
            $url = $uploadedFile->getSecurePath();

            return response()->json([
                'public_id' => $publicId,
                'url' => $url,
            ], StatusCode::HTTP_CREATED);
        } catch (\Exception $e) {
            Log::error('Error in ' . __METHOD__ . ': ' . $e->getMessage());

            return response()->json(['error' => 'Failed to upload image'], StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updateUploadFile(Request $request, $publicId, $folder)
    {
        try {
            $file = $request->file('file');

            if (!$file) {
                return response()->json(['error' => 'No image file provided'], StatusCode::HTTP_BAD_REQUEST);
            }

            Cloudinary::destroy($publicId);

            $uploadedFile = Cloudinary::upload($file->getRealPath(), [
                'folder' => $folder,
            ]);

            $newPublicId = $uploadedFile->getPublicId();
            $newUrl = $uploadedFile->getSecurePath();

            return response()->json([
                'public_id' => $newPublicId,
                'url' => $newUrl,
            ], StatusCode::HTTP_OK);
        } catch (\Exception $e) {
            Log::error('Error in ' . __METHOD__ . ': ' . $e->getMessage());

            return response()->json(['error' => 'Failed to update image'], StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroyUploadFile($publicId)
    {
        try {
            Cloudinary::destroy($publicId);

            return response()->json([
                'message' => 'Image deleted successfully',
            ], StatusCode::HTTP_OK);
        } catch (\Exception $e) {
            Log::error('Error in ' . __METHOD__ . ': ' . $e->getMessage());

            return response()->json(['error' => 'Failed to delete image'], StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}