<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CmsImage;
use App\Http\Requests\GalleryRequest;
use File;

class CmsImageController extends Controller
{

   
    public function index()
    {
        $gallery = CmsImage::orderBy('updated_at', 'desc')->paginate();
        return view('backend.cms.gallery.index', compact('gallery'));
    }

    public function store(GalleryRequest $request)
    {
        $picture = new CmsImage();
        $picture->title = $request->title;
        if($request->hasfile('image')){
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('/images/gallery'), $imageName);
            $picture->image = $imageName;
        }
        $picture->sort = $request->sort;
        $picture->save();
    	
        return redirect()->route('admin.cms.gallery.index')
          ->withFlashSuccess('Imagen guardada con éxito');

    }

    public function destroy($id)
    {

        try {
            $picture = CmsImage::findOrFail($id);

            if ($picture->image) {
                File::delete(public_path("/images/gallery/".$picture->image));
            }

            $picture->delete();
        } catch (\Exception $e) {
            return redirect()->back()->withFlashDanger(__('exceptions.backend.access.general.cant_delete'));
        }


        return redirect()->route('admin.cms.gallery.index')->withFlashSuccess('Imagen eliminada con éxito');
    }

}
