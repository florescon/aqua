<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>{{ $payment->user->name }} - @lang('labels.backend.access.subscription.payment')</title>

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
      <td align="left"><strong>Fecha generado:</strong> {{ $payment->created_at }}</td>
    </tr>
  </table>

  <table width="100%">
    <tr>
        <td><strong>Inicia:</strong> {{ $payment->start_date }}</td>
    </tr>
    <tr>
        <td><strong>Finaliza:</strong> {{ $payment->finish_date }}</td>
    </tr>
    <tr>
     <td><strong>Folio: </strong> #{{ $payment->id }}</td>
    </tr>
    @if($payment->payment_method_id)
    <tr>
      <td><strong>Método pago:</strong> {{ optional($payment->payment_method)->name }}</td>
    </tr>
    @endif
  </table>





  <table width="100%">
    <tr>
        <td><strong>A:</strong> {{ $payment->user->name }}</td>
        <td><strong>Expedido por:</strong> {{ $payment->generated_by->name }}</td>
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
        <td align="center">@lang('labels.backend.access.subscription.payment')</td>
        <td align="right">${{ $payment->price }}</td>
        <td align="right">${{ $payment->price }}</td>
      </tr>
    </tbody>

    <tfoot>
        <tr>
            <td colspan="1"></td>
            <td align="right">Total $</td>
            <td align="right" class="gray">${{ $payment->price }}</td>
        </tr>
    </tfoot>
  </table>

  <table width="100%">
    <tr>
        <td>{{ $payment->ticket_text }}</td>
    </tr>
  </table>

</body>
</html>