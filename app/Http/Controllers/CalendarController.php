<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calendar;

class CalendarController extends Controller
{


    public function index()
    {
        $calendar = Calendar::orderBy('updated_at', 'desc')->paginate();
        return view('backend.cms.schedule.index', compact('calendar'));
    }

    public function front()
    {
        $calendar = Calendar::orderBy('sort', 'desc')->paginate();
        return view('frontend.schedule', compact('calendar'));
    }


    public function store(Request $request)
    {

        $this->validate($request, [
            'schedule'   => 'required',
            'sort' => 'min:0|max:250',
        ]);

        $schedule = new Calendar();
        $schedule->schedule = $request->schedule;
        $schedule->mon = $request->mon;
        $schedule->tue = $request->tue;
        $schedule->wed = $request->wed;
        $schedule->thu = $request->thu;
        $schedule->fri = $request->fri;
        $schedule->sat = $request->sat;
        $schedule->sort = $request->sort;
        $schedule->save();

        return redirect()->route('admin.cms.schedule.index')
          ->withFlashSuccess('Horario guardado con éxito');

    }

    public function update(Request $request)
    {

        $this->validate($request, [
            'schedule'   => 'required',
            'sort' => 'min:0|max:250',
        ]);

        $calendar = Calendar::findOrFail($request->id);
        $calendar->update($request->all());

        return redirect()->route('admin.cms.schedule.index')
          ->withFlashSuccess('Horario actualizado con éxito');
    }

    public function destroy($id)
    {
        try {
            $schedule = Calendar::findOrFail($id);

            if ($schedule->image) 
            {
                File::delete(public_path("/images/staff/".$schedule->image));
            }

            $schedule->delete();
        } catch (\Exception $e) {
            return redirect()->back()->withFlashDanger(__('exceptions.backend.access.general.cant_delete'));
        }


        return redirect()->route('admin.cms.schedule.index')->withFlashSuccess('Horario eliminado con éxito');
    }


}


