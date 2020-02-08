<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;
use App\Http\Requests\SectionRequest;
use App\Http\Requests\SectionUpdateRequest;
use DataTables;
use Carbon;

class SectionController extends Controller
{

    public function index(Request $request)
    {
    	// $sections = Section::orderBy('updated_at', 'desc')->paginate();
    	// return view('backend.class.section.index', compact('sections'));

        if ($request->ajax()) {
            $data = Section::query();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="#" data-toggle="modal" data-placement="top" title="'.__('buttons.general.crud.edit').'" class="btn btn-primary" data-id="'.$row->id.'" data-myname="'.$row->name.'" data-target="#editSection"><i class="fas fa-edit"></i></a>';
                           $btn = $btn. '
                            <a href="'.route('admin.class.section.destroy', $row->id) .'" class="btn btn-delete btn-outline-danger" data-method="delete" data-trans-button-cancel="'. __('buttons.general.cancel') .'" data-trans-button-confirm="'. __('buttons.general.crud.delete') .'" data-trans-title="'. __('strings.backend.general.are_you_sure') .'" class="dropdown-item">
                                <i class="fas fa-eraser"></i>
                            </a>
                           ';
     
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('backend.class.section.index');

    }


    public function store(SectionRequest $request)
    {
    
    $input = $request->all();
   	$section = Section::create($input);
	
	return redirect()->route('admin.class.section.index')
      ->withFlashSuccess('Seccion guardada con éxito');

    }

    public function update(SectionUpdateRequest $request)
    {

        $type = Section::findOrFail($request->id);
        $type->update($request->all());

        return redirect()->route('admin.class.section.index')
          ->withFlashSuccess('Seccion actualizada con éxito');
    }

    public function destroy($id)
    {

        try {
            $section = Section::findOrFail($id);
            $section->delete();
        } catch (\Exception $e) {
            return redirect()->back()->withFlashDanger(__('exceptions.backend.access.general.cant_delete'));
        }


        return redirect()->route('admin.class.section.index')->withFlashSuccess('Seccion eliminada con éxito');
    }

    public function select2LoadMore(Request $request)
    {
        $search = $request->get('search');
        $data = Section::select(['id', 'name'])->where('name', 'like', '%' . $search . '%')->orderBy('name')->paginate(5);
        return response()->json(['items' => $data->toArray()['data'], 'pagination' => $data->nextPageUrl() ? true : false]);
    }

}
