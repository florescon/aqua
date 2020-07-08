@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.subscription.management'))

@section('breadcrumb-links')
    @include('backend.subscriptions.inscription.includes.breadcrumb-links')
@endsection

@push('after-styles')
    <link  href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="//cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">   

@endpush

@section('content')

<div class="card">

    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.subscription.management') }}
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
				<div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
				    <a href="#" data-toggle="modal" class="btn btn-success ml-1" title="@lang('labels.general.create_new')" data-target="#addModal"><i class="fas fa-plus-circle"></i></a>
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
                            <th>@lang('labels.backend.access.subscription.table.user')</th>
                            <th>@lang('labels.backend.access.subscription.table.end')</th>
                            <th>@lang('labels.backend.access.subscription.table.last_payment_date')</th>
                            <th>@lang('labels.general.actions') </th>
                        </tr>
                        </thead>
                        <tbody>
                        {{-- @foreach($subscriptions as $subscription)
                            <tr>
                                <td>
                                  <a class="btn btn-sm btn-outline-dark" href="{{ route('admin.subscription.subscription.show', $subscription->id) }}" role="button">
                                    #{{ $subscription->id }}
                                  </a>
                                </td>
                                <td>
                                    {{ $subscription->user->name }}
                                </td>
                                <td>{{ $subscription->start_date }}</td>
                                <td>{{ $subscription->finish_date }}</td>
                                <td>
                                  @if(isset($subscription->payments_one))
                                  <a href="#" class="btn btn-sm btn-secondary btn-lg" tabindex="-1" role="button" aria-disabled="true">
                                    @if(Carbon::now()->diffInDays($subscription->payments_one->finish_date, false) >= 0)
                                      {{ Carbon::now()->diffInDays($subscription->payments_one->finish_date, false) }} 
                                      @lang('labels.backend.access.subscription.table.days_left')
                                    @else
                                        @lang('labels.backend.access.subscription.table.past_due')
                                    @endif
                                    ⇉ {{ $subscription->payments_one->finish_date }}
                                  </a>
                                  @else
                                  <a href="#" class="btn btn-sm btn-secondary btn-lg disabled" tabindex="-1" role="button" aria-disabled="true">
                                    @lang('labels.backend.access.subscription.table.no_data')
                                  </a>
                                  @endif
                                </td>
                                <td> 

                                    <div class="btn-group" role="group" aria-label="_{{ _('labels.backend.access.users.user_actions') }}">
    
                                        <a href="{{ route('admin.subscription.subscription.show', $subscription->id) }}"  data-placement="top" title="{{ __('buttons.general.crud.view') }}" class="btn btn-info"><i class="fas fa-eye"></i></a>

                                        <a href="{{ route('admin.subscription.subscription.generate', $subscription->id) }}"  data-placement="top" title="{{ __('buttons.general.crud.print') }}" target="_blank" class="btn btn-outline-info"><i class="fas fa-print"></i></a>

                                        <a href="#" data-toggle="modal" data-target="#editModal" data-placement="top" title="{{ __('buttons.general.crud.edit') }}" data-subid="{{ $subscription->id }}"  data-price="{{ $subscription->price }}" data-mycomment="{{ $subscription->comment }}" data-start="{{ $subscription->start_date }}" data-end="{{ $subscription->finish_date }}" data-paymentmethod="{{ optional($subscription->payment_method)->name }}" data-texticket="{{ $subscription->ticket_text }}" data-name="{{ $subscription->user->name }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                        @can('mensualidades')
                                        <a href="#" data-toggle="modal" data-target="#paymentModal" data-placement="top" data-userid="{{ $subscription->user->id }}" data-subid="{{ $subscription->id }}" data-name="{{ $subscription->user->name }}" title="{{ __('buttons.general.crud.edit') }}" class="btn btn-warning"> @lang('labels.backend.access.subscription.payment')</a>
                                        @endcan

                                          <div class="btn-group btn-group-sm" role="group">
                                            <button id="userActions" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              {{ __('labels.general.more') }}
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="userActions">

                                              <a href="{{ route('admin.subscription.subscription.destroy', $subscription->id) }}"  data-toggle="tooltip" title="{{ __('buttons.general.crud.delete') }}" data-method="delete" data-trans-button-cancel="{{ __('buttons.general.cancel') }}" data-trans-button-confirm="{{ __('buttons.general.crud.delete') }}" data-trans-title="{{ __('strings.backend.general.are_you_sure') }}" class="dropdown-item"> @lang('labels.backend.access.subscription.delete')
                                              </a>
                                            </div>
                                          </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody> --}}
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                  {{-- {!! $subscriptions->total() !!} {{ trans_choice('labels.backend.access.subscription.table.total', $subscriptions->total()) }} --}}
                  </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {{-- {{ $subscriptions->links() }} --}}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->



<!-- Modal new -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalLabel">@lang('labels.backend.access.subscription.create')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    <form autocomplete="off" method="POST" action="{{ route('admin.subscription.subscription.store') }}">
       {{ csrf_field() }}
      <div class="modal-body">
      
          <div class="form-group">
          <label for="user" class="col-form-label">@lang('labels.backend.access.subscription.table.user'):</label>
            <select type="text" name="user" class="form-control" id="user" required>
            
            </select>
          </div>

         <div class="form-group row">
            <div class="col-md-12">
            <label for="start" class="col-form-label">@lang('labels.backend.access.subscription.table.start'):</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fa fa-calendar-alt"></i>
                  </span>
                </div>
                <input style="position: relative; z-index: 100000;" type="text" class="datepicker form-control" name="start_index" id="start_index" readonly required>
              </div>

            </div>
          </div>

         <div class="form-group row">
            <div class="col-md-12">
            <label for="name" class="col-form-label">@lang('labels.backend.access.subscription.table.price'):</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="fas fa-dollar-sign"></i>
                  </span>
                </div>
                <input class="form-control" id="price" type="number" name="price">
              </div>
            </div>
          </div>


          <div class="form-group">
            <label for="ticket_text" class="col-form-label">@lang('labels.backend.access.subscription.table.text_ticket'):</label>
            <textarea rows="2"  class="form-control" name="ticket_text" id="ticket_text"></textarea>
          </div>

          <div class="form-group">
            <label for="comment" class="col-form-label">@lang('labels.backend.access.subscription.table.comment'):</label>
            <textarea rows="2"  class="form-control" name="comment" id="comment"></textarea>
          </div>

          <div class="form-group">
          <label for="payment_method" class="col-form-label">@lang('labels.backend.access.subscription.table.payment_method'):</label>
            <select type="text" name="payment_method" class="form-control" id="payment_method" required>
            </select>
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
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="paymentModalLabel">@lang('labels.backend.access.payment.create') </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    <form autocomplete="off" method="POST" action="{{ route('admin.subscription.payment.store') }}">
       {{ csrf_field() }}

      <div class="modal-body">
          <input type="hidden" name="user" id="user_id" value="">
          <input type="hidden" name="sub" id="sub_id" value="">

         <div class="form-group row">
            <div class="col-md-12">
            <label for="name" class="col-form-label">@lang('labels.backend.access.payment.table.start'):</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fa fa-calendar-alt"></i>
                  </span>
                </div>
                <input style="position: relative; z-index: 100000;" type="text" class="datepicker form-control" name="start_" id="start_" readonly required>
              </div>
            </div>
          </div>



         <div class="form-group row">
            <div class="col-md-12">
            <label for="name" class="col-form-label">@lang('labels.backend.access.subscription.table.price'):</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="fas fa-dollar-sign"></i>
                  </span>
                </div>
                <input class="form-control" id="price_" type="number" name="price_">
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="tags" class="col-form-label">@lang('labels.backend.access.payment.table.tag'):</label>
            <select type="text" multiple="multiple" name="tags[]" class="form-control" id="tags" >
                {{-- <option value="">@lang('labels.general.select_option')</option> --}}
                {{-- @foreach($tags as $tag)
                    <option value="{{$tag->id}}" {{ old('tag') ? 'selected' : '' }}>{{$tag->name}}</option>
                @endforeach --}}
            </select>
          </div>

          <div class="form-group">
            <label for="comment_" class="col-form-label">@lang('labels.backend.access.subscription.table.comment'):</label>
            <textarea rows="2"  class="form-control" name="comment_" id="comment_"></textarea>
          </div>

          <div class="form-group">
            <label for="ticket_text_" class="col-form-label">@lang('labels.backend.access.subscription.table.text_ticket'):</label>
            <textarea rows="2"  class="form-control" name="ticket_text_" id="ticket_text_"></textarea>
          </div>

          <div class="form-group">
          <label for="payment_method_" class="col-form-label">@lang('labels.backend.access.payment.table.payment_method'):</label>
            <select type="text" name="payment_method_" class="form-control" id="payment_method_" required>
            </select>
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


<!-- Modal edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">@lang('labels.backend.access.subscription.edit') </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    <form autocomplete="off" method="POST" action="{{ route('admin.subscription.subscription.update', 'test') }}">
      {{method_field('patch')}}
      @csrf
      <div class="modal-body">
          <input type="hidden" name="sub" id="sub_id" value="">

         <div class="form-group row">
            <div class="col-md-12">
            <label for="name" class="col-form-label">@lang('labels.backend.access.subscription.table.start'):</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fa fa-calendar-alt"></i>
                  </span>
                </div>
                <input style="position: relative; z-index: 100000;" type="text" class="datepicker form-control" name="start_date" id="start_date" readonly required>
              </div>
            </div>
          </div>

         <div class="form-group row">
            <div class="col-md-12">
            <label for="name" class="col-form-label">@lang('labels.backend.access.subscription.table.end'):</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fa fa-calendar-alt"></i>
                  </span>
                </div>
                <input style="position: relative; z-index: 100000;" type="text" class="form-control" name="end" id="end" readonly required>
              </div>
            </div>
          </div>

         <div class="form-group row">
            <div class="col-md-12">
            <label for="price" class="col-form-label">@lang('labels.backend.access.subscription.table.price'):</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="fas fa-dollar-sign"></i>
                  </span>
                </div>
                <input class="form-control" id="price" type="number" name="price" disabled>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="comment" class="col-form-label">@lang('labels.backend.access.subscription.table.comment'):</label>
            <textarea rows="2"  class="form-control" name="comment" id="comment"></textarea>
          </div>

          <div class="form-group">
            <label for="ticket_text" class="col-form-label">@lang('labels.backend.access.subscription.table.text_ticket'):</label>
            <textarea rows="2"  class="form-control" name="ticket_text" id="ticket_text"></textarea>
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
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>

    $(function () {
      var table = $('.data-table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.subscription.subscription.index') }}",
        language: {
          "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
        },
        order: ['0', 'desc'], 
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'user.first_name'},
            {data: 'finish_date', name: 'finish_date'},
            {data: 'payment', name: 'payments_one.finish_date'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
      });
    
    });

        $(document).ready(function() {
            $('.datepicker').datepicker({
                language: 'es',
                dateFormat: 'dd-mm-yy',
                autoclose: true,
                todayHighlight: true,

            });
        });

        $.datepicker.regional['es'] = {
          closeText: 'Cerrar',
          prevText: '&#x3C;Ant',
          nextText: 'Sig&#x3E;',
          currentText: 'Hoy',
          monthNames: ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto',
            'septiembre', 'octubre', 'noviembre', 'diciembre'
          ],
          monthNamesShort: ['ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic'],
          dayNames: ['domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'],
          dayNamesShort: ['dom', 'lun', 'mar', 'mié', 'jue', 'vie', 'sáb'],
          dayNamesMin: ['D', 'L', 'M', 'X', 'J', 'V', 'S'],
          weekHeader: 'Sm',
          dateFormat: 'dd/mm/yy',
          firstDay: 1,
          isRTL: false,
          showMonthAfterYear: false,
          yearSuffix: ''
        };

        $.datepicker.setDefaults($.datepicker.regional['es']);


        $('#paymentModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget)
          var user_id = button.data('userid')
          var sub_id = button.data('subid')
          var name = button.data('name')
          var modal = $(this)

          modal.find('.modal-body #user_id').val(user_id)
          modal.find('.modal-body #sub_id').val(sub_id)
          modal.find('.modal-title').text('@lang('labels.backend.access.payment.create') - ' + name)
        });


        $('#editModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget)
          var sub_id = button.data('subid')
          var start_ = button.data('start')
          var end_ = button.data('end')
          var name = button.data('name')
          var price_ = button.data('price')
          var comment_ = button.data('mycomment')
          var paymentmethod_ = button.data('paymentmethod') 
          var ticket_text_ = button.data('texticket')
          var modal = $(this)

          modal.find('.modal-body #sub_id').val(sub_id)
          modal.find('.modal-body #start_date').val(start_)
          modal.find('.modal-body #end').val(end_)
          modal.find('.modal-body #price').val(price_)
          modal.find('.modal-body #comment').val(comment_)
          modal.find('.modal-body #paymentmethod').val(paymentmethod_)
          modal.find('.modal-body #ticket_text').val(ticket_text_)
          modal.find('.modal-title').text('@lang('labels.backend.access.subscription.edit') - ' + name)
        });

        $(document).ready(function() {
            $('#tags').select2({
              ajax: {
                    url: '{{ route('admin.subscription.tag.select') }}',
                    data: function (params) {
                        return {
                            search: params.term,
                            page: params.page || 1
                        };
                    },
                    dataType: 'json',
                    processResults: function (data) {
                        data.page = data.page || 1;
                        return {
                            results: data.items.map(function (item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                };
                            }),
                            pagination: {
                                more: data.pagination
                            }
                        }
                    },
                    cache: true,
                    delay: 250
                },
                placeholder: '@lang('labels.backend.access.payment.table.tag')',
                multiple: true,
                width: 'resolve'
              });
        });

        $(document).ready(function() {
            $('#user').select2({
              ajax: {
                    url: '{{ route('admin.user.select') }}',
                    data: function (params) {
                        return {
                            search: params.term,
                            page: params.page || 1
                        };
                    },
                    dataType: 'json',
                    processResults: function (data) {
                        data.page = data.page || 1;
                        return {
                            results: data.items.map(function (item) {
                                return {
                                    id: item.id,
                                    text: item.first_name + ' ' + item.last_name
                                };
                            }),
                            pagination: {
                                more: data.pagination
                            }
                        }
                    },
                    cache: true,
                    delay: 250
                },
                placeholder: '@lang('labels.backend.access.users.user')',
                width: 'resolve'
              });
        });

        $(document).ready(function() {
            $('#payment_method').select2({
              ajax: {
                    url: '{{ route('admin.setting.method.select') }}',
                    data: function (params) {
                        return {
                            search: params.term,
                            page: params.page || 1
                        };
                    },
                    dataType: 'json',
                    processResults: function (data) {
                        data.page = data.page || 1;
                        return {
                            results: data.items.map(function (item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                };
                            }),
                            pagination: {
                                more: data.pagination
                            }
                        }
                    },
                    cache: true,
                    delay: 250
                },
                placeholder: '@lang('labels.backend.access.sell.payment_method')',
                width: 'resolve'
              });
        });


        $(document).ready(function() {
            $('#payment_method_').select2({
              ajax: {
                    url: '{{ route('admin.setting.method.select') }}',
                    data: function (params) {
                        return {
                            search: params.term,
                            page: params.page || 1
                        };
                    },
                    dataType: 'json',
                    processResults: function (data) {
                        data.page = data.page || 1;
                        return {
                            results: data.items.map(function (item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                };
                            }),
                            pagination: {
                                more: data.pagination
                            }
                        }
                    },
                    cache: true,
                    delay: 250
                },
                placeholder: '@lang('labels.backend.access.sell.payment_method')',
                width: 'resolve'
              });
        });
       </script>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

@endpush