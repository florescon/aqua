<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SmallBox;
use App\Income;
use App\DataTables\SmallBoxDataTable;
use App\Http\Requests\SmallboxRequest;
use App\Http\Requests\SmallboxUpdateRequest;
use DataTables;
use Carbon;

class SmallBoxController extends Controller
{

    public function index(SmallBoxDataTable $dataTable)
    {
        // $smallbox = SmallBox::orderBy('updated_at', 'desc')->paginate();
        $income = SmallBox::whereType('1')->sum('amount');
        $expenditure = SmallBox::whereType('2')->sum('amount');
        $total = $income-$expenditure;

        return $dataTable->render('backend.transaction.smallbox.index', compact('income', 'expenditure', 'total'));

        // return view('backend.transaction.smallbox.index', compact('income', 'expenditure', 'total'));

    }

    public function store(SmallboxRequest $request)
    {
    
	    $smallbox = new SmallBox();
        $smallbox->name = $request->name;
        $smallbox->amount = $request->amount;
        $smallbox->comment = $request->comment;
        $smallbox->type = $request->type;

        if($smallbox->save()){
            if($request->checkbox==1 && $smallbox->type==2){
                $income = new Income();
                $income->name = 'Ingreso desde la caja chica #'.$smallbox->id;
                $income->price = $request->amount;
                $income->save();
            }
        }

   
    return redirect()->route('admin.transaction.small.index')
      ->withFlashSuccess('Operacion guardada con éxito');

    }

    public function update(SmallboxUpdateRequest $request)
    {

        $type = SmallBox::findOrFail($request->id);
        $type->update($request->all());

        return redirect()->route('admin.transaction.small.index')
          ->withFlashSuccess('Operacion actualizado con éxito');
    }

    public function destroy($id)
    {

        try {
            $income = SmallBox::findOrFail($id);
            $income->delete();
        } catch (\Exception $e) {
            return redirect()->back()->withFlashDanger(__('exceptions.backend.access.general.cant_delete'));
        }


        return redirect()->route('admin.transaction.small.index')->withFlashSuccess('Operacion eliminada con éxito');
    }


}
