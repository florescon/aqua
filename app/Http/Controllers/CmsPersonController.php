<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CmsPerson;
use App\Http\Requests\PersonRequest;
use File;


class CmsPersonController extends Controller
{

    public function index()
    {
        $staff = CmsPerson::orderBy('updated_at', 'desc')->paginate();
        return view('backend.cms.staff.index', compact('staff'));

    }

    public function store(PersonRequest $request)
    {

        $staff = new CmsPerson();
        $staff->name = $request->name;
        $staff->job = $request->address;
        if($request->hasfile('image')){
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('/images/staff'), $imageName);
            $staff->image = $imageName;
        }
        $staff->facebook = $request->facebook;
        $staff->twitter = $request->twitter;
        $staff->instagram = $request->instagram;
        $staff->youtube = $request->youtube;
        $staff->save();

        return redirect()->route('admin.cms.staff.index')
          ->withFlashSuccess('Staff guardado con éxito');

    }


    public function destroy($id)
    {
        try {
            $staff = CmsPerson::findOrFail($id);

            if ($staff->image) 
            {
                File::delete(public_path("/images/staff/".$staff->image));
            }

            $staff->delete();
        } catch (\Exception $e) {
            return redirect()->back()->withFlashDanger(__('exceptions.backend.access.general.cant_delete'));
        }


        return redirect()->route('admin.cms.staff.index')->withFlashSuccess('Staff eliminado con éxito');
    }



}
