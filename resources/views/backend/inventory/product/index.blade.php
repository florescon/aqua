@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.product.management'))

@push('after-styles')
@endpush

@section('content')


<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.product.management') }}
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
        <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">

            <a href="#" data-toggle="modal" class="btn btn-success ml-1" title="@lang('labels.general.create_new')" data-target="#newProduct"><i class="fas fa-plus-circle"></i></a>
        </div><!--btn-toolbar-->

            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-striped data-table" style="width:100%">
                        <thead>
                        <tr>
                            <th>Folio</th>
                            <th>@lang('labels.backend.access.product.table.name')</th>
                            <th>@lang('labels.backend.access.product.table.code')</th>
                            <th>@lang('labels.backend.access.product.table.quantity')</th>
  	                        <th>@lang('labels.backend.access.product.table.price')</th>
                            {{-- <th>@lang('labels.backend.access.product.table.created')</th> --}}
                            <th>@lang('labels.backend.access.product.table.last_updated')</th>
                            <th>@lang('labels.general.actions') </th>
                        </tr>
                        </thead>
                        <tbody>
                        {{-- @foreach($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->code }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>${{ $product->price }}</td>
                                <td>{{ $product->created_at->diffForHumans() }}</td>
                                <td>{{ $product->updated_at->diffForHumans() }}</td>
                                <td> 
                                <div class="btn-group" role="group" aria-label="_{{ _('labels.backend.access.users.user_actions') }}">

                                    <a href="#" data-toggle="modal" data-placement="top" title="{{ __('buttons.general.crud.edit') }}" class="btn btn-primary" data-id="{{ $product->id }}" data-myname="{{ $product->name }}" data-myquantity="{{ $product->quantity }}" data-mycode="{{ $product->code }}" data-myprice="{{ $product->price }}" data-target="#editProduct"><i class="fas fa-edit"></i></a>

                                    <a href="#" data-toggle="modal" data-target="#stockModal" data-placement="top" data-product_id="{{ $product->id }}" data-name="{{ $product->name }}" data-quantity="{{ $product->quantity }}" title="{{ __('buttons.general.crud.edit') }}" class="btn btn-outline-info"><i class="fas fa-minus"></i>  @lang('labels.backend.access.product.table.quantity') <i class="fas fa-plus"></i></a>


                                    <a href="{{ route('admin.inventory.product.destroy', $product->id) }}" class="btn btn-danger" data-method="delete" data-trans-button-cancel="{{ __('buttons.general.cancel') }}" data-trans-button-confirm="{{ __('buttons.general.crud.delete') }}" data-trans-title="{{ __('strings.backend.general.are_you_sure') }}" class="dropdown-item">
                                      <i class="fas fa-eraser"></i>
                                    </a>
                                </div>
                                </td>
                            </tr>
                        @endforeach --}}
                        <tfoot>
                            <th>Folio</th>
                            <th>@lang('labels.backend.access.product.table.name')</th>
                            <th>@lang('labels.backend.access.product.table.code')</th>
                            <th>@lang('labels.backend.access.product.table.quantity')</th>
                            <th>@lang('labels.backend.access.product.table.price')</th>
                            {{-- <th>@lang('labels.backend.access.product.table.created')</th> --}}
                            <th>@lang('labels.backend.access.product.table.last_updated')</th>
                            <th>@lang('labels.general.actions') </th>
                        </tfoot>
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {{-- {!! $products->total() !!} {{ trans_choice('labels.backend.access.product.table.total', $products->total()) }} --}}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {{-- {{ $products->links() }} --}}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->


<!-- Modal -->
<div class="modal fade" id="newProduct" tabindex="-1" role="dialog" aria-labelledby="newProductLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newProductLabel">@lang('labels.backend.access.product.create')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    <form autocomplete="off" method="POST" action="{{ route('admin.inventory.product.store') }}">
       @csrf
      <div class="modal-body">
          {{-- <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="fa fa-user"></i>
                </span>
              </div>
              <input class="form-control" id="username" type="text" name="username" placeholder="Username">
            </div>
          </div> --}}

          <div class="form-group">
            <label for="name" class="col-form-label">@lang('labels.backend.access.product.table.name'):</label>
            <input type="text" class="form-control" name="name" id="name" required>
          </div>

          <div class="form-group">
            <label for="name" class="col-form-label">@lang('labels.backend.access.product.table.code'):</label>
            <input type="text" class="form-control" name="code" id="code" required>
          </div>

          <div class="form-group">
            <label for="name" class="col-form-label">@lang('labels.backend.access.product.table.quantity'):</label>
            <input type="number" class="form-control" name="quantity" id="quantity" required>
          </div>

          <div class="form-group">
            <label for="name" class="col-form-label">@lang('labels.backend.access.product.table.price'):</label>
            <input type="number" class="form-control" name="price" id="price" required>
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
<div class="modal fade" id="editProduct" tabindex="-1" role="dialog" aria-labelledby="editProductLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editProductLabel">@lang('labels.backend.access.product.edit')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    <form autocomplete="off" method="POST" action="{{ route('admin.inventory.product.update', 'test') }}">
        {{method_field('patch')}}
        @csrf

      <div class="modal-body">
          <div class="form-group">
            <input type="hidden" name="id" id="id" value="">
            <label for="name" class="col-form-label">@lang('labels.backend.access.product.table.name'):</label>
            <input type="text" class="form-control" name="name" id="name" required>
          </div>

          <div class="form-group">
            <label for="name" class="col-form-label">@lang('labels.backend.access.product.table.code'):</label>
            <input type="text" class="form-control" name="code" id="code" required>
          </div>

          <div class="form-group">
            <label for="name" class="col-form-label">@lang('labels.backend.access.product.table.price'):</label>
            <input type="number" class="form-control" name="price" id="price" required>
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


<!-- Modal payment -->
<div class="modal fade" id="stockModal" tabindex="-1" role="dialog" aria-labelledby="stockModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="stockModalLabel">@lang('labels.backend.access.payment.create') </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    <form autocomplete="off" method="POST" action="{{ route('admin.inventory.product.addstock', 'test') }}">
       @csrf
      <div class="modal-body">
        <input type="hidden" name="id" id="id" value="">
          <div class="form-group row">
            <div class="col-md-12">
            <label for="name" class="col-form-label">@lang('labels.backend.access.product.table.actually_quantity'):</label>
              <div class="input-group">
                <div class="input-group-prepend">
                </div>
                <input class="form-control" id="quantity" type="number" name="quantity" disabled>
              </div>
            </div>

            <div class="col-md-12">
            <label for="name" class="col-form-label">@lang('labels.backend.access.product.add_quantity'):</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="fas fa-minus-circle"></i>
                  </span>
                </div>
                <input class="form-control" id="quantity_" type="number" name="quantity_">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="fas fa-plus-circle"></i>
                  </span>
                </div>

              </div>
            </div>
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
    $('#editProduct').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var name = button.data('myname')
      var code = button.data('mycode')
      var quantity = button.data('myquantity')
      var price = button.data('myprice')
      var id = button.data('id')
      var modal = $(this)


      modal.find('.modal-body #name').val(name)
      modal.find('.modal-body #code').val(code)
      modal.find('.modal-body #quantity').val(quantity)
      modal.find('.modal-body #price').val(price)
      modal.find('.modal-body #id').val(id)
    })

    $('#stockModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var id = button.data('product_id')
      var name = button.data('name')
      var quantity_ = button.data('quantity')
      var modal = $(this)

      modal.find('.modal-body #id').val(id)
      modal.find('.modal-body #name').val(name)
      modal.find('.modal-body #quantity').val(quantity_)
      modal.find('.modal-title').text('@lang('labels.backend.access.product.add_quantity') - ' + name)
    })


    $(function () {
      let table = $('.data-table').DataTable({
        dom: 'lBfrtip',
        buttons: [
          {
              extend: 'excel',
              text: '<i class="fa fa-download"></i>&nbsp;Excel &nbsp; <i class="fas fa-file-excel"></i>',
              messageTop: 'Excel',
          },
          {
              extend: 'csv',
              text: '<i class="fa fa-download"></i>&nbsp;CSV &nbsp; <i class="fas fa-file-csv"></i>',
              messageTop: 'CSV',
          },
          {
              extend: 'print',
              text: 'Imprimir&nbsp;<i class="fa fa-print"></i>',
              messageTop: 'Imprimir',
          },
          {
              extend: 'reset',
              text: 'Recargar&nbsp;<i class="fa fa-undo"></i>',

          },
        ],
        // select: true,
        responsive: true,
        processing: true,
        serverSide: true,
        autoWidth: false,
        ajax: "{{ route('admin.inventory.product.index') }}",
        language: {
          "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
        },
        order: ['5', 'desc'], 
        columnDefs: [
            {
                "targets": [0],
                "visible": false,
                "searchable": false
            }        
        ],
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'code', name: 'code'},
            {data: 'quantity', name: 'quantity'},
            {data: 'price', name: 'price', render: $.fn.dataTable.render.number( ',', '.', 2, '$' )},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
      });
    
    });

</script>

@endpush