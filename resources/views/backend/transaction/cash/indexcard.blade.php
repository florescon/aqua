@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.cash_out.management'))

@section('breadcrumb-links')
    @include('backend.transaction.cash.includes.breadcrumb-links')
@endsection

@section('content')

  <div class="col-lg-12">

    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="alert-heading"><i class="fas fa-exclamation-triangle"></i> ¡Atención!</h4>
            Seleccionó el método de pago <u>Tarjeta</u><br/>
    </div>

    <div class="card">
      <div class="card-header">
          <a href="{{ route('admin.transaction.cash.index') }}" class="btn btn-brand btn-spotify mb-1">
            <span>Ver todos los movimientos</span>
          </a>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#sales" role="tab" aria-controls="sales">
          <i class="nav-icon fa fa-dollar-sign"></i> @lang('labels.backend.access.cash_out.table.sales')
          @if($sales->count())<span class="badge badge-success">{{ $sales->count() }}</span>@endif
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#inscriptions" role="tab" aria-controls="inscriptions">
          <i class="nav-icon fa fa-credit-card"></i> @lang('labels.backend.access.cash_out.table.inscriptions')
          @if($inscriptions->count())<span class="badge badge-pill badge-success">{{ $inscriptions->count() }}</span>@endif
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#payments" role="tab" aria-controls="payments">
          <i class="nav-icon fa fa-clipboard-list"></i> @lang('labels.backend.access.cash_out.table.monthly_payments')
          @if($payments->count())<span class="badge badge-pill badge-success">{{ $payments->count() }}</span>@endif
        </a>
      </li>
      @if(isset($latest) && empty($latest->final))
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#cashout" role="tab" aria-controls="cashout">
          <span class="badge badge-pill badge-warning">Detalles de movimientos</span>
        </a>
      </li>
      @endif
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="sales" role="tabpanel">
        <table class="table table-responsive-sm">
          <thead>
            <tr>
              <th>Folio</th>
              <th>@lang('labels.backend.access.cash_out.table.user')</th>
              <th>@lang('labels.backend.access.cash_out.table.show_text_ticket')</th>
              <th>@lang('labels.backend.access.cash_out.table.payment')</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            @php($totalsale=0)
            @foreach($sales as $sale)
            <tr>
              <td>
              <a href="{{ route('admin.inventory.sell.show', $sale->id) }}">#{{ $sale->id }}</a>
              </td>
              <td>
                @if($sale->user_id)
                  {{ optional($sale->user)->name }} 
                @else
                  <span class="badge badge-pill badge-secondary"> <em>No asignado</em></span>
                @endif
              </td>
              <td>
                @if(isset($sale->ticket_text))
                  {{ $sale->ticket_text }}
                @else
                  <span class="badge badge-pill badge-secondary"> <em>No definido</em></span>
                @endif
              </td>
              <td>{{ optional($sale->payment)->name }}</td>
              <td>
                @php($total=0)
                @foreach($sale->products as $saleproduct)

                  @php($total+=$saleproduct->quantity*$saleproduct->product_detail->price)

                @endforeach
              ${{ $total }}
                </td>
            </tr>
            @php($totalsale+=$total)
            @endforeach

            <tr>
              <td></td>
              <td></td>
              <td></td>
              <th align="right">Total</th>
              <th><span class="badge badge-pill badge-success">${{ $totalsale }}</span></th>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="tab-pane" id="inscriptions" role="tabpanel">
        <table class="table table-responsive-sm">
          <thead>
            <tr>
              <th>Folio</th>
              <th>@lang('labels.backend.access.cash_out.table.user')</th>
              <th>Comentario</th>
              <th>Pago</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            @php($totalinscription=0)
            @foreach($inscriptions as $inscription)
            <tr>
              <td>#{{ $inscription->id }}</td>
              <td>{{ $inscription->user->name }}</td>
              <td>
                @if(!empty($inscription->comment))
                  {{ $inscription->comment }}
                @else
                  <span class="badge badge-pill badge-secondary"> <em>No definido</em></span>
                @endif
              </td>
              <td>
                @if(isset($inscription->payment_method_id))
                  {{ optional($inscription->payment_method)->name }}
                @else
                  <span class="badge badge-pill badge-secondary"> <em>No definido</em></span>
                @endif
              </td>
              <td>${{ $inscription->price }}</td>
            </tr>
            @php($totalinscription+=$inscription->price)
            @endforeach
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <th align="right">Total</th>
              <th><span class="badge badge-pill badge-success">${{ $totalinscription }}</span></th>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="tab-pane" id="payments" role="tabpanel">
        <table class="table table-responsive-sm">
          <thead>
            <tr>
              <th>Folio</th>
              <th>@lang('labels.backend.access.cash_out.table.user')</th>
              <th>Comentario</th>
              <th>Pago</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            @php($totalpayment=0)
            @foreach($payments as $payment)
            <tr>
              <td>#{{ $payment->id }}</td>
              <td>{{ $payment->user->name }}</td>
              <td>
                @if(isset($payment->comment))
                  {{ $payment->comment }}
                @else
                  <span class="badge badge-pill badge-secondary"> <em>No definido</em></span>
                @endif
              </td>
              <td>{{ optional($payment->payment_method)->name }}</td>
              <td>${{ $payment->price }}</td>
            </tr>
            @php($totalpayment+=$payment->price)
            @endforeach
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <th align="right">Total</th>
              <th><span class="badge badge-pill badge-success">${{ $totalpayment }}</span></th>
            </tr>
          </tbody>
        </table>        
      </div>
      @if(isset($latest))      
      <div class="tab-pane" id="cashout" role="tabpanel">
        <form id="final" action="{{route('admin.transaction.cash.updatefinal', $latest->id)}}" method="POST">
        {{method_field('patch')}}
        @csrf
        <table class="table table-responsive-sm">
          <thead>
            <tr>
              <th>@lang('labels.backend.access.cash_out.table.name')</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>@lang('labels.backend.access.cash_out.table.sales')</td>
              <td><span class="badge badge-pill badge-success">${{ $totalsale }}</span></td>
            </tr>
            <tr>
              <td>@lang('labels.backend.access.cash_out.table.inscriptions')</td>
              <td><span class="badge badge-pill badge-success">${{ $totalinscription }}</span></td>
            </tr>
            <tr>
              <td>@lang('labels.backend.access.cash_out.table.monthly_payments')</td>
              <td><span class="badge badge-pill badge-success">${{ $totalpayment }}</span></td>
            </tr>
            <tr>
              <th style="text-align: right;">Total</th>
              <th>
              @php($final=$totalsale+$totalinscription+$totalpayment)
              <input class="form-control col-sm-3" id="final" name="final" type="number" min="1" placeholder="Cantidad" value="{{ $final }}" readonly>

            </tr>
          </tbody>
        </table>
        </form>
      </div>
      @endif      
    </div>
  </div>
  <!-- /.col-->





<!-- Modal -->
<div class="modal fade" id="cashModal" tabindex="-1" role="dialog" aria-labelledby="cashModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cashModalLabel">@lang('labels.backend.access.cash_out.table.initial_quantity')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    <form autocomplete="off" method="POST" action="{{ route('admin.transaction.cash.initial') }}">
       @csrf
      <div class="modal-body">
          <div class="form-group">
            <label for="quantity" class="col-form-label">@lang('labels.backend.access.cash_out.table.quantity'):</label>
            <input type="number" min="0" class="form-control" name="quantity" id="quantity" >
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('labels.general.buttons.close')</button>
        <button type="submit" class="btn btn-primary">@lang('labels.general.buttons.save')</button>
      </div>
    </form>

    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="editSection" tabindex="-1" role="dialog" aria-labelledby="editSectionLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editSectionLabel">@lang('labels.backend.access.cash_out.edit_quantity')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    <form autocomplete="off" method="POST" action="{{ route('admin.transaction.cash.updateinitial', 'test') }}">
        {{method_field('patch')}}
        @csrf
      <div class="modal-body">
          <div class="form-group">
            <label for="quantity_" class="col-form-label">@lang('labels.backend.access.cash_out.table.quantity'):</label>
            <input type="hidden" name="id" id="id" value="">
            <input type="number" min="0" class="form-control" name="quantity_" id="quantity_" required>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('labels.general.buttons.close')</button>
        <button type="submit" class="btn btn-primary">@lang('labels.general.buttons.save')</button>
      </div>
    </form>

    </div>
  </div>
</div>

@endsection


@push('after-scripts')
<script>
    $('#editSection').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var quantity = button.data('myquantity')
      var id = button.data('id')
      var modal = $(this)


      modal.find('.modal-body #quantity_').val(quantity)
      modal.find('.modal-body #id').val(id)
    });
</script>
@endpush