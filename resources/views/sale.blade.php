<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>{{ optional($sale->user)->name }}</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: medium;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: medium;
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
      <td align="left"><strong>Fecha generado:</strong> {{ $sale->created_at }}</td>
    </tr>
  </table>

  <table width="100%">
    <tr>
        @if($sale->payment)
        <td><strong>Método pago:</strong> {{ optional($sale->payment)->name }}</td>
        @endif
        <td><strong>Folio:</strong> #{{ $sale->id }}</td>
    </tr>
  </table>

  <table width="100%">
    <tr>
        @if($sale->user)
        <td><strong>A:</strong> {{ optional($sale->user)->name }}</td>
        @endif
        <td><strong>Expedido por:</strong> {{ $sale->generated_by->name }}</td>
    </tr>
  </table>

  <br/>

  <table width="100%">
    <thead style="background-color: lightgray;">
      <tr align="center">
        <th>Concepto</th>
        <th>Cantidad</th>
        <th>Precio</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      @php($total=0)
      @foreach($sale->products as $sales)
      <tr>
        <th scope="row">{{ $sales->product_detail->name.' '.$sales->product_detail->code }}</th>
        <td align="center">{{ $sales->quantity }}</td>
        <td align="right">${{ number_format($sales->product_detail->price, 2, ".", ",") }}</td>
        <td align="right">${{ number_format($sales->quantity*$sales->product_detail->price, 2, ".", ",") }}</td>
      </tr>
      @php($total+=$sales->quantity*$sales->product_detail->price)
      @endforeach
    </tbody>

    <tfoot>
        <tr>
            <td colspan="2"></td>
            <td align="right">Total $</td>
            <td align="right" class="gray">${{ number_format($total, 2, ".", ",") }}</td>
        </tr>
    </tfoot>
  </table>

  <table width="100%">
    <tr>
        <td>{{ $sale->ticket_text }}</td>
    </tr>
  </table>

</body>
</html>