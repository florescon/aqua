<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClassroomType;
use App\Http\Requests\TypeRequest;
use App\Http\Requests\TypeUpdateRequest;
use DataTables;
use Carbon;

class ClassroomTypesController extends Controller
{
    public function index(Request $request)
    {
    	// $types = ClassroomType::orderBy('updated_at', 'desc')->paginate();
    	// return view('backend.class.class_type.index', compact('types'));

        if ($request->ajax()) {
            $data = ClassroomType::query();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="#" data-toggle="modal" data-placement="top" title="'.__('buttons.general.crud.edit').'" class="btn btn-primary" data-id="'.$row->id.'" data-myname="'.$row->name.'" data-target="#editClassType"><i class="fas fa-edit"></i></a>';
                           $btn = $btn. '
                           <a href="'. route('admin.class.type.destroy', $row->id) .'" class="btn btn-delete btn-outline-danger" data-method="delete" data-trans-button-cancel="'. __('buttons.general.cancel') .'" data-trans-button-confirm="'. __('buttons.general.crud.delete') .'" data-trans-title="'. __('strings.backend.general.are_you_sure') .'" class="dropdown-item">
                              <i class="fas fa-eraser"></i>
                            </a>
                           ';
     
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('backend.class.class_type.index');

    }


    public function store(TypeRequest $request)
    {
    
        $input = $request->all();
       	$type = ClassroomType::create($input);
    	
    	return redirect()->route('admin.class.type.index')
          ->withFlashSuccess('Tipo de clase guardado con éxito');
    }


    public function update(TypeUpdateRequest $request)
    {

        $type = ClassroomType::findOrFail($request->id);
        $type->update($request->all());

        return redirect()->route('admin.class.type.index')
          ->withFlashSuccess('Tipo de clase actualizado con éxito');
    }


    public function destroy($id)
    {
        try {
            $type = ClassroomType::findOrFail($id);
            $type->delete();
        } catch (\Exception $e) {
            return redirect()->back()->withFlashDanger(__('exceptions.backend.access.general.cant_delete'));
        }

        return redirect()->route('admin.class.type.index')->withFlashSuccess('Tipo de clase eliminado con éxito');
    }


    public function select2LoadMore(Request $request)
    {
        $search = $request->get('search');
        $data = ClassroomType::select(['id', 'name'])->where('name', 'like', '%' . $search . '%')->orderBy('name')->paginate(5);
        return response()->json(['items' => $data->toArray()['data'], 'pagination' => $data->nextPageUrl() ? true : false]);
    }


}
