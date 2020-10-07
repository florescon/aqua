@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.subscription.view'))

@push('after-styles')
@endpush

@section('content')
            <div class="row">
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <i class="fa fa-user"></i>@lang('labels.backend.access.subscription.info_user')</div>
                  <div class="card-body">
                    <table class="table table-responsive-sm table-striped">
                      <tbody>
                        <tr>
                          <th>@lang('labels.backend.access.subscription.table.name')</th>
                          <td>{{ $subscription->user->name }}</td>
                        </tr>
                        <tr>
                          <th>@lang('labels.backend.access.subscription.table.email')</th>
                          <td>{{ $subscription->user->email }}</td>
                        </tr>
                        <tr>
                          <th>@lang('labels.backend.access.subscription.table.created')</th>
                          <td>{{ Carbon::parse($subscription->user->created_at)->format('d-m-Y h:i:s a') }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="card">
                  <div class="card-header">
                    <i class="fa fa-credit-card"></i>@lang('labels.backend.access.subscription.details')</div>
                  <div class="card-body">
                    <table class="table table-responsive-sm table-striped">
                      <tbody>
                        <tr>
                          <th>@lang('labels.backend.access.subscription.table.generated_by')</th>
                          <td>{{ $subscription->generated_by->name }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                @if($subscription->payments->count())
                <div class="card">
                  <div class="card-header">
                    <i class="fas fa-print"></i>@lang('labels.backend.access.subscription.print_join_payment')</div>
                  <div class="card-body">
                    <div class="form-group">
                    <form  method="POST" action="{{ route('admin.subscription.subscription.printpayments', $subscription->id) }}" target="_blank">
                       @csrf
                      <label for="payment" class="col-form-label">@lang('labels.backend.access.subscription.payment'):</label>
                      <select type="text" multiple="multiple" name="payment[]" class="form-control" id="payment" required>
                          {{-- <option value="">@lang('labels.general.select_option')</option> --}}
                          {{-- @foreach($tags as $tag)
                              <option value="{{$tag->id}}" {{ old('tag') ? 'selected' : '' }}>{{$tag->name}}</option>
                          @endforeach --}}
                      </select>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">@lang('labels.general.buttons.print')</button>
                      </div>
                    </form>
                    </div>
                  </div>
                </div>
                @endif

              </div>

              <div class="col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <i class="fa fa-credit-card"></i>@lang('labels.backend.access.subscription.details')
                      <a href="{{ route('admin.subscription.subscription.generate', $subscription->id) }}" target="_blank"><span class="badge badge-warning">@lang('labels.backend.access.subscription.print')</span></a>
                  </div>
                  <div class="card-body">
                    <table class="table table-responsive-sm table-striped">
                      <tbody>
                        <tr>
                          <th>Folio @lang('labels.backend.access.subscription.subscription')</th>
                          <td>#{{ $subscription->id }}</td>
                        </tr>
                        <tr>
                          <th>@lang('labels.backend.access.subscription.table.start')</th>
                          <td>{{ $subscription->start_date }}</td>
                        </tr>
                        <tr>
                          <th>@lang('labels.backend.access.subscription.table.end')</th>
                          <td>{{ $subscription->finish_date }}</td>
                        </tr>
                        @isset($subscription->payment_method_id)
                        <tr>
                          <th>@lang('labels.backend.access.subscription.table.payment_method')</th>
                          <td>{{ optional($subscription->payment_method)->name }}</td>
                        </tr>
                        @endisset
                      </tbody>
                    </table>
                    @if($subscription->comment)
                      <div class="alert alert-warning" role="alert">
                        <h4 class="alert-heading">@lang('labels.backend.access.subscription.table.comment')</h4>
                        <hr>
                        <p class="mb-0">{!! $subscription->comment !!}</p>
                      </div>
                    @endif
                    @if($subscription->ticket_text)
                      <div class="alert alert-secondary" role="alert">
                        <h4 class="alert-heading">@lang('labels.backend.access.subscription.table.show_text_ticket')</h4>
                        <hr>
                        <p class="mb-0">{!! $subscription->ticket_text !!}</p>
                      </div>
                    @endif
                  </div>
                </div>
              </div>


            </div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.subscription.view_payments') }}
                    <a class="badge badge-info" style="color:white;">{{ $subscription->payments()->count() }}</a>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                    <a href="#" data-toggle="modal" data-target="#paymentModal" data-userid="{{ $subscription->user->id }}" data-subid="{{ $subscription->id }}" data-name="{{ $subscription->user->name }}" class="btn ml-1 btn-outline-info" title="@lang('labels.general.create_new')">@lang('labels.backend.access.subscription.add_payment') <i class="fas fa-plus-circle"></i></a>
                </div><!--btn-toolbar-->

            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    @can('mensualidades')
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Folio</th>
                            <th>@lang('labels.backend.access.subscription.table.user')</th>
                            <th>@lang('labels.backend.access.subscription.table.price')</th>
                            <th>@lang('labels.backend.access.subscription.table.start')</th>
                            <th>@lang('labels.backend.access.subscription.table.end')</th>
                            <th>@lang('labels.backend.access.subscription.table.tags')</th>
                            <th>@lang('labels.backend.access.subscription.table.last_updated')</th>
                            <th>@lang('labels.backend.access.subscription.table.generated_by')</th>
                            <th>@lang('labels.general.actions') </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subscription->payments as $payment)
                            <tr>
                                <td>#{{ $payment->id }}</td>
                                <td>{{ $payment->user->name }}</td>
                                <td>${{ number_format($payment->price, 2, ".", ",") }}</td>
                                <td>{{ $payment->start_date }}</td>
                                <td>{{ $payment->finish_date }}</td>

                                <td> 
                                  @foreach($payment->tags as $tag)
                                      <button type="button" class="btn btn-sm btn-outline-dark">
                                        {{ $tag->name }}
                                      </button>
                                  @endforeach
                                </td>
                                <td>{{ $payment->updated_at->diffForHumans() }}</td>
                                <td>{!! $payment->generated_by->name !!}</td> 
                                <td> 
                                <div class="btn-group" role="group" aria-label="_{{ _('labels.backend.access.users.user_actions') }}">

                                  <a href="{{ route('admin.subscription.payment.generate', $payment->id) }}" title="{{ __('buttons.general.crud.print') }}" target="_blank" class="btn btn-outline-info"><i class="fas fa-print"></i></a>

                                  @if($payment->comment)
                                  <a class="btn btn-info" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" data-placement="top" title="@lang('labels.backend.access.subscription.table.comment')" data-content="{!! $payment->comment !!}">
                                  <i class="fa fa-comments" aria-hidden="true"></i>
                                  </a>
                                  @endif

                                  @role('administrator')
                                  <a href="{{ route('admin.subscription.payment.destroy', $payment->id) }}" class="btn btn-danger" data-method="delete" data-trans-button-cancel="@lang('buttons.general.cancel')" data-trans-button-confirm="@lang('buttons.general.crud.delete')" data-trans-title="@lang('strings.backend.general.are_you_sure')" class="dropdown-item">
                                      <i class="fas fa-eraser"></i>
                                  </a>
                                  @endrole
                                </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @endcan
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->




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
       @csrf

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



@endsection

@push('after-scripts')
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(document).ready(function() {
            $('.datepicker').datepicker({
                language: 'es',
                dateFormat: 'dd-mm-yy',
                autoclose: true,
                todayHighlight: true

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

        $(function () {
          $('[data-toggle="popover"]').popover()
        });


        $(document).ready(function() {
            $('.select2').select2({
                maximumSelectionSize: 6,
                width: 'resolve'
              });
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
                maximumSelectionSize: 6,
                multiple: true,
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



        $(document).ready(function() {
            $('#payment').select2({
              ajax: {
                    url: '{{ route('admin.subscription.payment.select', $subscription->id) }}',
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
                                    text: '#' + item.id
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
                placeholder: '@lang('labels.backend.access.subscription.payment')',
                width: 'resolve'
              });
        });

       </script>
@endpush
