<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\ProductDetail;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Requests\ServiceRequest;
use App\Http\Requests\ServiceUpdateRequest;
use PDF;
use DataTables;
use Carbon;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        // $products = Product::orderBy('updated_at', 'desc')->where('type', 1)->paginate();
        // return view('backend.inventory.product.index', compact('products'));

        if ($request->ajax()) {
            // select('id', 'name', 'address', 'created_at', 'updated_at')
            $data = Product::query()->where('type', 1);
            return Datatables::of($data)
                    ->addIndexColumn()
                    // ->editColumn('created_at', function ($dat) {
                    //     return $dat->created_at ? with(new Carbon($dat->created_at))->format('d-m-Y H:i:s') : '';
                    // })
                    ->addColumn('action', function($row){
                           $btn = '
                           <div class="btn-group" role="group" aria-label="'. __('labels.backend.access.users.user_actions') .'">
                            <a href="'. route('admin.inventory.product.show', $row->id) .'" data-toggle="tooltip" data-placement="top" title="'. __('buttons.general.crud.view') .'" class="btn btn-info"><i class="fas fa-eye"></i></a>

                           <a href="#" data-toggle="modal" data-placement="top" title="'. __('buttons.general.crud.edit') .'" class="btn btn-primary" data-id="'. $row->id .'" data-myname="'. $row->name .'" data-myquantity="'. $row->quantity .'" data-mycode="'. $row->code .'" data-myprice="'. $row->price .'" data-target="#editProduct"><i class="fas fa-edit"></i></a>
                            ';
                            $btn = $btn.'
                                <a href="#" data-toggle="modal" data-target="#stockModal" data-placement="top" data-product_id="'. $row->id .'" data-name="'. $row->name .'" data-quantity="'. $row->quantity .'" title="'. __('buttons.general.crud.edit') .'" class="btn btn-outline-info"><i class="fas fa-minus"></i>  '.__('labels.backend.access.product.table.quantity').' <i class="fas fa-plus"></i></a>
                            ';
                            $btn = $btn.'
                                <a href="'.route('admin.inventory.product.destroy', $row->id).'" class="btn btn-delete btn-outline-danger" title="'.$row->name.'" data-trans-button-confirm="'. __('buttons.general.crud.delete').'"  data-trans-button-cancel="'.__('buttons.general.cancel').'" data-trans-text="'.__('strings.backend.general.revert_this').'" data-trans-title="'.__('strings.backend.general.are_you_sure_delete').'" data-trans-success="'.__('strings.backend.general.success').'" data-trans-deleted="'.__('strings.backend.general.deleted').'" data-trans-wrong="'.__('strings.backend.general.wrong').'"><i class="fas fa-eraser"></i>
                                </a>
                            </div>    
                            ';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('backend.inventory.product.index');

    }

    public function store(ProductRequest $request)
    {

        $service = new Product;
        $service->name = $request->name;
        $service->code = $request->code;
        $service->quantity = $request->quantity;
        $service->price = $request->price;
        $service->type = 1;
        $service->save();
        
        return redirect()->route('admin.inventory.product.index')
          ->withFlashSuccess('Producto guardado con éxito');

    }

    public function show($id)
    {
        $product = Product::with('detail')->findOrFail($id);
        $details = ProductDetail::where('product_id', $id)->paginate(10);
        return view('backend.inventory.product.show', compact('product', 'details'));
    }

    public function update(ProductUpdateRequest $request)
    {

        $product = Product::findOrFail($request->id);
        $product->update($request->all());

        return redirect()->route('admin.inventory.product.index')
          ->withFlashSuccess('Producto actualizado con éxito');
    }


    public function addstock(Request $request)
    {
        $this->validate($request, [
            'quantity_' => 'required',
        ]);
        $product = Product::findOrFail($request->id);
        $actualquantity = $product->quantity;
        $product->quantity = $actualquantity  + $request->quantity_;
        if ($product->update()) {
            $log = new ProductDetail();
            $log->product_id = $product->id;
            $log->old_quantity = $actualquantity;
            $log->quantity = $request->quantity_;
            $log->audi_id = Auth::id();
            $log->save();
            return redirect()->route('admin.inventory.product.index')->withFlashSuccess('Cantidad actualizada con exito');
        } else {
            return redirect()->route('admin.inventory.product.index')->withFlashDanger('Error');
        }
    }

    public function destroy($id)
    {

        try {
            $product = Product::findOrFail($id);
            $product->delete();
        } catch (\Exception $e) {
            return redirect()->back()->withFlashDanger(__('exceptions.backend.access.general.cant_delete'));
        }


        return redirect()->route('admin.inventory.product.index')->withFlashSuccess('Producto eliminado con éxito');
    }

    public function select2LoadMore(Request $request)
    {
        $search = $request->get('search');
        $data = Product::select(['id', 'name', 'code', 'quantity', 'price'])->where('name', 'like', '%' . $search . '%')->orWhere('code', 'like', '%' . $search . '%')->orderBy('name')->paginate(5);
        return response()->json(['items' => $data->toArray()['data'], 'pagination' => $data->nextPageUrl() ? true : false]);
    }





    
    public function indexs(Request $request)
    {
        // $services = Product::orderBy('updated_at', 'desc')->where('type', 2)->paginate();
        // return view('backend.inventory.service.index', compact('services'));

        if ($request->ajax()) {
            $data = Product::query()->where('type', 2);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('created_at', function ($dat) {
                        return $dat->created_at ? with(new Carbon($dat->created_at))->format('d-m-Y H:i:s') : '';
                    })
                    ->editColumn('updated_at', function ($dat) {
                        return $dat->updated_at ? with(new Carbon($dat->updated_at))->format('d-m-Y H:i:s') : '';
                    })
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="#" data-toggle="modal" data-placement="top" title="'.__('buttons.general.crud.edit').'" class="btn btn-primary" data-id="'.$row->id.'" data-myname="'.$row->name.'" data-myprice="'. $row->price .'" data-target="#editService"><i class="fas fa-edit"></i></a>';
                           $btn = $btn. '
                            <a href="'.route('admin.inventory.service.destroy', $row->id).'" class="btn btn-delete btn-outline-danger" title="'.$row->name.'" data-trans-button-confirm="'. __('buttons.general.crud.delete').'"  data-trans-button-cancel="'.__('buttons.general.cancel').'" data-trans-text="'.__('strings.backend.general.revert_this').'" data-trans-title="'.__('strings.backend.general.are_you_sure_delete').'" data-trans-success="'.__('strings.backend.general.success').'" data-trans-deleted="'.__('strings.backend.general.deleted').'" data-trans-wrong="'.__('strings.backend.general.wrong').'"><i class="fas fa-eraser"></i>
                            </a>

                           ';
     
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('backend.inventory.service.index');

    }

    public function stores(ServiceRequest $request)
    {

        $service = new Product;
        $service->name = $request->name;
        $service->price = $request->price;
        $service->type = 2;
        $service->save();
        // $product = Product::create($input);
        
        return redirect()->route('admin.inventory.service.index')
          ->withFlashSuccess('Servicio guardado con éxito');

    }

    public function updates(ServiceUpdateRequest $request)
    {

        $service = Product::findOrFail($request->id);
        $service->update($request->all());

        return redirect()->route('admin.inventory.service.index')
          ->withFlashSuccess('Servicio actualizado con éxito');
    }


    public function destroys($id)
    {

        try {
            $service = Product::findOrFail($id);
            $service->delete();
        } catch (\Exception $e) {
            return redirect()->back()->withFlashDanger(__('exceptions.backend.access.general.cant_delete'));
        }


        return redirect()->route('admin.inventory.service.index')->withFlashSuccess('Servicio eliminado con éxito');
    }

}
