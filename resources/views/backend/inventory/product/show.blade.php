@extends('backend.layouts.app')

@section('content')
<div class="container">
  <div class="card">

    <div class="card-header">
    
    <strong>Folio: #{{ $product->id }}</strong> 

    </div>
      <div class="card-body">
        <div class="row mb-4">
          
          <div class="col-sm-6">
	          <h6 class="mb-3"><strong>@lang('labels.backend.access.product.table.actually_quantity'):</strong></h6>
	            <div>
	              {{ $product->quantity }}
	            </div>
	          <br>
	          
	          <div>
		          <strong>@lang('labels.backend.access.sell.table.created'):</strong>
	          </div>
	          <div>
	          	{{ $product->created_at }}
	          </div>
          </div>
          <div class="col-sm-6">
	          <h6 class="mb-3"><strong>@lang('labels.backend.access.product.table.name'):</strong></h6>
		        <div>
		          {{ $product->name }}
		        </div>

	          <br>

	          <div>
	          	<strong>@lang('labels.backend.access.product.table.code'):</strong>
	          </div>
	          <div>
	           {{ $product->code }}
	          </div>

	          <br>

	          <div>
	          	<strong>@lang('labels.backend.access.product.table.price'):</strong>
	          </div>
	          <div>
	           ${{ number_format($product->price, 2, ".", ",") }}
	          </div>
          </div>

        </div>

        @if($product->detail->count())
        <div class="table-responsive-sm">
          <table class="table table-striped">
          <thead>
            <tr>
              <th>@lang('labels.backend.access.sell.table.concept')</th>
              <th class="right">@lang('labels.backend.access.product.table.quantity')</th>
              <th class="right">@lang('labels.backend.access.product.table.movement')</th>
              <th class="right">@lang('labels.backend.access.product.table.generated_by')</th>
            </tr>
          </thead>
            <tbody>
            	@foreach($product->detail as $pro)
	            <tr>
	              <td class="left">@lang('labels.backend.access.product.table.amount_changed')</td>
	              <td class="right">{{ $pro->quantity }}</td>
	              <td class="right">De {{ $pro->old_quantity }} a {{ $pro->old_quantity+$pro->quantity }}</td>
	              <td class="right">{{ optional($pro->generated_by)->name }}</td>
	            </tr>
	            @endforeach
            </tbody>
          </table>
        </div>
        @endif

        <div class="row">
          <div class="col-lg-4 col-sm-5">
          </div>

          <div class="col-lg-4 col-sm-5 ml-auto">
            <table class="table table-clear">
              <tbody>

              </tbody>
            </table>
          </div>
        </div>

      </div>
  </div>
</div>

@endsection
