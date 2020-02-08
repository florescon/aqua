@extends('backend.layouts.app')

@section('content')

<div class="container">
  <div class="card">

    <div class="card-header">
    Ticket.
    <strong>Hoy: {{ Carbon::today()->toDateString() }}</strong> 

    <a class="btn btn-sm btn-info float-right" href="#" onclick="javascript:window.print();">
      <i class="fa fa-print"></i> 
      Imprimir
    </a>
    </div>
      <div class="card-body">
        <div class="row mb-4">
          <div class="col-sm-6">
          <h6 class="mb-3">A:</h6>
            <div>
              <strong>{{ $subscriptions->user->name }}</strong>
            </div>
            <div>{{ $subscriptions->user->email }}</div>
          </div>
          <div class="col-sm-6">
          <h6 class="mb-3">Expedido por:</h6>
            <div>
              <strong>{{ $subscriptions->generated_by->name }}</strong>
            </div>
            <div>{{ $subscriptions->generated_by->email }}</div>
          </div>

        </div>

        <div class="table-responsive-sm">
          <table class="table table-striped">
          <thead>
            <tr>
              <th>Description</th>

              <th class="right">Fecha expedido </th>
              <th class="right">Total</th>
            </tr>
          </thead>
            <tbody>
            <tr>
              <td class="left">@lang('labels.backend.access.subscription.subscription')</td>

              <td class="right">{{ $subscriptions->created_at }}</td>
              <td class="right">${{ $subscriptions->price }}</td>
            </tr>
            </tbody>
          </table>
        </div>
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
