<?php

namespace Bubalubs\Gravity\Controllers;

use Illuminate\Http\Request;
use Bubalubs\Gravity\Media;
use Bubalubs\Gravity\PageContent;
use Bubalubs\Gravity\MediaLibraryUpload;

class MediaController extends Controller
{
    public function manage()
    {
        $mediaLibrary = Media::latest()->get();

        return view('gravity::manage-media')->with(compact(
            'mediaLibrary'
        ));
    }

    public function create(Request $request)
    {
        $mediaUpload = MediaLibraryUpload::create();

        $media = $mediaUpload->addMediaFromRequest('file')
            ->withResponsiveImages()
            ->toMediaCollection('library');

         return redirect('/admin/media')->with('success', 'Successfully uploaded media');
    }

    public function uploadImage(Request $request)
    {
        $mediaUpload = MediaLibraryUpload::create();

        $media = $mediaUpload->addMediaFromRequest('file')
            ->withResponsiveImages()
            ->toMediaCollection('library');

        return response()->json($media);
    }

    public function edit(int $id)
    {
        $media = Media::findOrFail($id);

        return view('gravity::edit-media')->with(compact(
            'media'
        ));
    }

    public function delete(int $id)
    {
        $media = Media::findOrFail($id);

        app($media->model_type)
            ->findOrFail($media->model_id)
            ->deleteMedia($media->id);

        return redirect('/admin/media')->with('success', 'Successfully deleted media');
    }

    public function getMediaImagesData()
    {
        return Media::latest()
            ->where('mime_type', 'LIKE', '%image%')
            ->limit(15)
            ->get();
    }
}
