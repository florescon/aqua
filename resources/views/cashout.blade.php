<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>#{{ $cash->id }} - @lang('labels.backend.access.cash_out.cash_out')</title>

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
      <td align="left"><strong>Fecha generado:</strong> {{ $cash->created_at }}</td>
    </tr>
  </table>

  <table width="100%">
    <tr>
     <td><strong>Corte: </strong> #{{ $cash->id }}</td>
    </tr>

    <tr>
     <td><strong>@lang('labels.backend.access.cash_out.table.cash_out_initial'): </strong> ${{ $cash->initial }}</td>
    </tr>
  </table>


  <table width="100%">
    <tr>
        @if(!empty($cash->user_id))
          <td><strong>A:</strong> {{ optional($cash->user)->name }}</td>
        @endif
        @if(!empty($cash->audi_id))
          <td><strong>Expedido por:</strong> {{ $cash->generated_by->name }}</td>
        @endif
    </tr>
  </table>

  <br/>

  <table width="100%">
    <thead style="background-color: lightgray;">
      <tr align="center">
        <th colspan="2">@lang('labels.backend.access.cash_out.cash_out')</th>
      </tr>
      <tr align="center">
        <th>Concepto</th>
        <th>Monto</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td align="center">@lang('labels.backend.access.cash_out.table.cash_out_final')</td>
        <td align="center">${{ $cash->final }}</td>
      </tr>
      @isset($cash->withdraw)
      <tr>
        <td align="center">@lang('labels.backend.access.cash_out.table.withdrawal')</td>
        <td align="center">-${{ $cash->withdraw }}</td>
      </tr>
      @endisset
    </tbody>

    <tfoot>
        <tr>
            <td align="right" colspan="1">Total $</td>
            <td align="center" class="gray">$
            @if($cash->withdraw)
              {{ $cash->withdraw_final }}
            @else
              {{ $cash->final }}
            @endif
            </td>
        </tr>
    </tfoot>
  </table>

  <table width="100%">
    <tr>
        <td>{{ $cash->ticket_text }}</td>
    </tr>
  </table>

</body>
</html>