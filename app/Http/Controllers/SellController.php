<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Sale;
use App\Cart;
use App\Product;
use App\ProductSale;
use DB;
use PDF;

class SellController extends Controller
{

    public function index()
    {
        $sales = Sale::orderBy('updated_at', 'desc')->paginate();
        return view('backend.inventory.sell.index', compact('sales'));
    }

    public function create()
    {
        $products = Cart::with('product')->where('audi_id', Auth::id())->get();
        // dd($products);
        return view('backend.inventory.sell.create', compact('products'));
    }

    public function storeCart(Request $request)
    {
        $this->validate($request, [
            'product' => 'required',
            'quantity' => 'required|required|not_in:0',
        ]);

        $product = Product::where(['id'=>$request->product])->first();

        if($product->type==1){
            if($product->quantity<$request->quantity){
                return redirect()->back()->withFlashDanger('Cantidad menor a la existente');
            }
        }        
        $dup = DB::table('carts')->where(['product_id'=>$request->product])->where('audi_id', Auth::id())->count();
        if($dup>=1){
            return redirect()->back()->withFlashDanger('Producto duplicado');
        }

        $cart = new Cart();
        $cart->product_id = $request->product;
        $cart->quantity = $request->quantity;
        $cart->audi_id = Auth::id();
        $cart->save();

        return redirect()->route('admin.inventory.sell.create')
          ->withFlashSuccess('Producto agregado con éxito');
    }   

    public function destroyCart($id)
    {

        try {
            $cart = Cart::findOrFail($id);
            $cart->delete();
        } catch (\Exception $e) {
            return redirect()->back()->withFlashDanger(__('exceptions.backend.access.general.cant_delete'));
        }


        return redirect()->route('admin.inventory.sell.create')->withFlashSuccess('Producto eliminado con éxito');
    }

    public function store(Request $request)
    {

        $products = Cart::with('product')->where('audi_id', Auth::id())->get();
        try {
            $sell = new Sale();
            $sell->user_id = $request->user;
            $sell->ticket_text = $request->ticket_text;
            $sell->payment_method_id = $request->payment;
            $sell->audi_id = Auth::id();
            $sell->save();

            foreach ($products as $entry) {


                $product = Product::find($entry->product_id);
                if($product->type==1){
                    $product->decrement('quantity', $entry->quantity);
                }
                ProductSale::create([
                    'sale_id' => $sell->id,
                    'product_id' => $entry->product_id,
                    'quantity' => $entry->quantity,
                    'price' => $entry->price
                ]);
            }
            // $sell->sale()->attach($products);
            DB::table('carts')->where('audi_id', Auth::id())->delete();
        } catch (\Exception $e) {
            return redirect()->back()->withFlashDanger('Error');

        }
        return redirect()->route('admin.inventory.sell.create')
          ->withFlashSuccess('Venta realizada con éxito');
    }


    public function show($id)
    {
        $sale = Sale::findOrFail($id);
        return view('backend.inventory.sell.show', compact('sale'));
    }



    public function latestSell(){
        $latest = Sale::latest('created_at')->first();
        try{       
            return $this->generatePDF($latest->id);
        }catch (\Exception $e) {
            return redirect()->back()->withFlashDanger('No se puede imprimir');
        }

    }

    public function generatePDF($id)
    {
        $data = ['title' => 'Bienvenido a '];
        // $pdf = PDF::loadView('mypdf', $data);
        $sale = Sale::findOrFail($id);

        $customPaper = array(0,0,667.00,283.80);
        $pdf = PDF::loadView('sale', compact('data', 'sale'))->setPaper($customPaper, 'landscape');

        return $pdf->stream($sale->id.'-venta.pdf');
    }


    public function search(Request $request){
        $searching = $request->input('search');

        //now get all user and services in one go without looping using eager loading
            //In your foreach() loop, if you have 1000 users you will make 1000 queries
          $sales = Sale::where('id','like','%'.$searching.'%')->orderBy('id')->paginate(15);
            return view('backend.inventory.sell.index', compact('sales'));
    }


    public function destroy($id)
    {
        $products = ProductSale::where('sale_id', $id)->get();
        try {

            foreach ($products as $entry) {

                $prod = Product::find($entry->product_id);
                if($prod->type==1){
                    $prod->increment('quantity', $entry->quantity);
                }
            }

            $delete = Sale::findOrFail($id);
            $delete->delete();
        } catch (\Exception $e) {
            return redirect()->back()->withFlashDanger(__('exceptions.backend.access.general.cant_delete'));
        }

        return redirect()->route('admin.inventory.sell.index')->withFlashSuccess('Venta eliminada con éxito');
    }


}
