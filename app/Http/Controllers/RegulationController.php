<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Regulation;
use App\Http\Requests\RegulationRequest;
use App\Http\Requests\RegulationEditRequest;
use PDF;

class RegulationController extends Controller
{
    
    public function index(Regulation $reg)
    {
        return view('backend.settings.regulation.index')->withRegulation($reg->first());
    }

    public function create()
    {
        return view('backend.settings.regulation.create');
    }


    public function store(RegulationRequest $request)
    {
    
    $input = $request->all();
   	$regulation = Regulation::create($input);
	
	return redirect()->route('admin.setting.regulation.index')
      ->withFlashSuccess('Reglamento guardado con éxito');

    }

    public function update(RegulationEditRequest $request, $id)
    {
        $regulation = Regulation::findOrFail($id);
        $input=$request->all();
        $regulation->update($input);

        return redirect()->route('admin.setting.regulation.index')
            ->withFlashSuccess('Reglamento actualizado con éxito');
    }

    public function generatePDF(Regulation $reg)
    {
        $data = ['title' => 'Welcome to '];
        $regulation = Regulation::where('id', 1)->first(); 

        $pdf = PDF::loadView('mypdf', compact('data', 'regulation'));


        // $customPaper = array(0,0,567.00,283.80);
        // $pdf = PDF::loadView('mypdf', compact('data', 'regulation'))->setPaper($customPaper, 'landscape');

        return $pdf->stream('reglamento.pdf');
    }



}
