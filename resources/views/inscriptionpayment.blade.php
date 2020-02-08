<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>{{ $subscription->user->name }} - @lang('labels.backend.access.subscription.subscription')-@lang('labels.backend.access.subscription.payment')</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
</style>

</head>
<body>

  <table width="100%">
  <tr>
    <td style="text-align: center;">
      <img src="{{ public_path('pro/img/azul.png') }}" alt="" width="100"/>
    </td>
  </tr>
    <tr>
        <td align="center">
            <h3>Aquática Azul</h3>
            <pre>
aquaticazul.com
Hernando de Martel 
(Interior calle de los naranjos) #30
Lagos de Moreno, Jal
474 742 1696
            </pre>
        </td>
    </tr>

  </table>


  <table width="100%">
    <tr>
      <td align="left"><strong>Fecha generado:</strong> {{ $subscription->created_at }}</td>
    </tr>
  </table>

  <table width="100%">
    <tr>
        <td><strong>Inicia:</strong> {{ $subscription->start_date }}</td>
    </tr>
    <tr>
        <td><strong>Finaliza:</strong> {{ $subscription->finish_date }}</td>
    </tr>
    <tr>
     <td><strong>Folio inscripción: </strong> #{{ $subscription->id }}</td>
    </tr>
    @if($subscription->payment_method_id)
    <tr>
      <td><strong>Método pago:</strong> {{ optional($subscription->payment_method)->name }}</td>
    </tr>
    @endif
  </table>





  <table width="100%">
    <tr>
        <td><strong>A:</strong> {{ $subscription->user->name }}</td>
        <td><strong>Expedido por:</strong> {{ $subscription->generated_by->name }}</td>
    </tr>
  </table>

  <br/>

  <table width="100%">
    <thead style="background-color: lightgray;">
      <tr align="center">
        <th>Concepto</th>
        <th>Precio</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td align="center">@lang('labels.backend.access.subscription.subscription')</td>
        <td align="right">${{ $subscription->price }}</td>
        <td align="right">${{ $subscription->price }}</td>
      </tr>
      @php($totalpayment=0)
      @foreach($payments as $payment)
      <tr>
        <td align="center">@lang('labels.backend.access.subscription.payment') - {{ $payment->start_date }}</td>
        <td align="right">${{ $payment->price }}</td>
        <td align="right">${{ $payment->price }}</td>
      </tr>
      @php($totalpayment+=$payment->price)
      @endforeach
      @php($total=$totalpayment+$subscription->price)
    </tbody>

    <tfoot>
        <tr>
            <td colspan="1"></td>
            <td align="right">Total $</td>
            <td align="right" class="gray">${{ $total }}</td>
        </tr>
    </tfoot>
  </table>

  <table width="100%">
    <tr>
        <td>{{ $subscription->ticket_text }}</td>
    </tr>
  </table>

</body>
</html>