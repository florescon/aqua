<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\School;
use App\Http\Requests\SchoolRequest;
use App\Http\Requests\SchoolUpdateRequest;
use File;
use DataTables;
use Carbon;

class SchoolController extends Controller
{

    public function index(Request $request)
    {
    	// $schools = School::orderBy('updated_at', 'desc')->paginate();
    	// return view('backend.settings.school.index', compact('schools'));

        if ($request->ajax()) {
            // select('id', 'name', 'address', 'created_at', 'updated_at')
            $data = School::query();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '
                           <div class="btn-group" role="group" aria-label="'. __('labels.backend.access.users.user_actions') .'">
                           <a href="#" data-toggle="modal" data-placement="top" title="'.__('buttons.general.crud.edit').'" class="btn btn-primary" data-id="'.$row->id.'" data-myname="'.$row->name.'" data-myavatar="'.$row->avatar_type.'" data-myaddress="'.$row->address.'" data-target="#editModal"><i class="fas fa-edit"></i></a> ';
                           $btn = $btn.'
                            <a href="'.route('admin.setting.school.destroy', $row->id).'" class="btn btn-delete btn-outline-danger" title="'.$row->name.'" data-trans-button-confirm="'. __('buttons.general.crud.delete').'"  data-trans-button-cancel="'.__('buttons.general.cancel').'" data-trans-text="'.__('strings.backend.general.revert_this').'" data-trans-title="'.__('strings.backend.general.are_you_sure_delete').'" data-trans-success="'.__('strings.backend.general.success').'" data-trans-deleted="'.__('strings.backend.general.deleted').'" data-trans-wrong="'.__('strings.backend.general.wrong').'"><i class="fas fa-eraser"></i></a>
                           </div>
                           ';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('backend.settings.school.index');

    }

    public function store(SchoolRequest $request)
    {


        $school = new School();
        $school->name = $request->name;
        if($request->hasfile('image')){
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $imageName);
            $school->avatar_type = $imageName;
        }
        $school->address = $request->address;
        $school->save();

        return redirect()->route('admin.setting.school.index')
          ->withFlashSuccess('Institución guardada con éxito');

    }

    public function update(SchoolUpdateRequest $request)
    {

        $school = School::findOrFail($request->id);
        $input=$request->all();


        if($file=$request->file('image'))
        {
 
            if ($school->avatar_type != 'gravatar')
            {
                File::delete(public_path("/images/".$school->avatar_type));
            }

            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $imageName);
            $school->avatar_type = $imageName;
        }   

        $school->update($input);

        return redirect()->route('admin.setting.school.index')
          ->withFlashSuccess('Institución actualizada con éxito');
    }

    public function destroy($id)
    {

        try {
            $school = School::findOrFail($id);

            if ($school->avatar_type) 
            {
                File::delete(public_path("/images/".$school->avatar_type));
            }

            $school->delete();
        } catch (\Exception $e) {
            return redirect()->back()->withFlashDanger(__('exceptions.backend.access.general.cant_delete'));
        }


        return redirect()->route('admin.setting.school.index')->withFlashSuccess('Institución eliminada con éxito');
    }


    public function select2LoadMore(Request $request)
    {
        $search = $request->get('search');
        $data = School::select(['id', 'name'])->where('name', 'like', '%' . $search . '%')->orderBy('name')->paginate(5);
        return response()->json(['items' => $data->toArray()['data'], 'pagination' => $data->nextPageUrl() ? true : false]);
    }


}
