<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Http\Requests\TagRequest;
use App\Http\Requests\TagUpdateRequest;
use DataTables;
use Carbon;

class TagPaymentController extends Controller
{

    public function index(Request $request)
    {
        // $sections = Tag::orderBy('updated_at', 'desc')->where('type', 2)->paginate();
    	// return view('backend.settings.tagpayment.index', compact('sections'));

        if ($request->ajax()) {
            $data = Tag::query()->where('type', 2);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('created_at', function ($dat) {
                        return $dat->created_at ? with(new Carbon($dat->created_at))->format('d-m-Y H:i:s') : '';
                    })
                    ->editColumn('updated_at', function ($dat) {
                        return $dat->updated_at ? with(new Carbon($dat->updated_at))->format('d-m-Y H:i:s') : '';
                    })
                    ->addColumn('action', function($row){
   
                        $btn = '<a href="#" data-toggle="modal" data-placement="top" title="'.__('buttons.general.crud.edit').'" class="btn btn-primary" data-id="'.$row->id.'" data-myname="'.$row->name.'" data-target="#editTag"><i class="fas fa-edit"></i></a>';
                        $btn = $btn.'
                            <a href="'.route('admin.subscription.tag.destroy', $row->id).'" class="btn btn-delete btn-outline-danger" title="'.$row->name.'" data-trans-button-confirm="'. __('buttons.general.crud.delete').'"  data-trans-button-cancel="'.__('buttons.general.cancel').'" data-trans-text="'.__('strings.backend.general.revert_this').'" data-trans-title="'.__('strings.backend.general.are_you_sure_delete').'" data-trans-success="'.__('strings.backend.general.success').'" data-trans-deleted="'.__('strings.backend.general.deleted').'" data-trans-wrong="'.__('strings.backend.general.wrong').'"><i class="fas fa-eraser"></i>
                            </a>
                        ';     
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('backend.settings.tagpayment.index');

    }


    public function store(TagRequest $request)
    {
    
        $tag = new Tag;
        $tag->name = $request->name;
        $tag->type = 2;
        $tag->save();
    	
    	return redirect()->route('admin.subscription.tag.index')
          ->withFlashSuccess('Etiqueta guardada con éxito');

    }

    public function update(TagUpdateRequest $request)
    {

        $type = Tag::findOrFail($request->id);
        $type->update($request->all());

        return redirect()->route('admin.subscription.tag.index')
          ->withFlashSuccess('Etiqueta actualizada con éxito');
    }

    public function destroy($id)
    {

        try {
            $section = Tag::findOrFail($id);
            $section->delete();
        } catch (\Exception $e) {
            return redirect()->back()->withFlashDanger(__('exceptions.backend.access.general.cant_delete'));
        }


        return redirect()->route('admin.subscription.tag.index')->withFlashSuccess('Etiqueta eliminada con éxito');
    }

    public function select2LoadMore(Request $request)
    {
        $search = $request->get('search');
        $data = Tag::select(['id', 'name'])->where('name', 'like', '%' . $search . '%')->orderBy('name')->where('type', 2)->paginate(5);
        return response()->json(['items' => $data->toArray()['data'], 'pagination' => $data->nextPageUrl() ? true : false]);
    }


}
