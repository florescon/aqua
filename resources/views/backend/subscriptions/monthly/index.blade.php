@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.payment.management'))


@section('content')

<div class="card">

    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.payment.management') }}
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                    <a href="#" data-toggle="modal" class="btn btn-success ml-1" title="@lang('labels.general.create_new')" data-target="#exampleModal"><i class="fas fa-plus-circle"></i></a>
                </div><!--btn-toolbar-->

            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>@lang('labels.backend.access.payment.table.user')</th>
                            <th>@lang('labels.backend.access.payment.table.price')</th>
                            <th>@lang('labels.backend.access.payment.table.start')</th>
                            <th>@lang('labels.backend.access.payment.table.end')</th>
                            <th>@lang('labels.backend.access.payment.table.last_updated')</th>
                            <th>@lang('labels.backend.access.payment.table.generated_by')</th>
                            <th>@lang('labels.general.actions') </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subscriptions as $payment)
                            <tr>
                                <td>{{ $payment->user->name }}</td>
                                <td>${{ $payment->price }}</td>
                                <td>{{ Carbon::parse($payment->start_date)->format('d-m-Y') }}</td>
                                <td>{{ Carbon::parse($payment->finish_date)->format('d-m-Y') }}</td>
                                <td>{{ $payment->updated_at->diffForHumans() }}</td>
                                <td>{!! $payment->generated_by->name !!} </td>
                                <td> 

                                @if($payment->comment)
                                <a class="btn btn-info" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="@lang('labels.backend.access.subscription.table.comment')" data-content="{!! $payment->comment !!}">
                                <i class="fa fa-comments" aria-hidden="true"></i>
                                </a>
                                @endif

                                <a href="{{ route('admin.subscription.payment.destroy', $payment->id) }}" class="btn btn-danger" data-method="delete" data-trans-button-cancel="@lang('buttons.general.cancel')" data-trans-button-confirm="@lang('buttons.general.crud.delete')" data-trans-title="@lang('strings.backend.general.are_you_sure')" class="dropdown-item">
                                    <i class="fas fa-eraser"></i>
                                </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {!! $subscriptions->total() !!} {{ trans_choice('labels.backend.access.payment.table.total', $subscriptions->total()) }} 
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {{ $subscriptions->links() }}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">@lang('labels.backend.access.payment.create')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    <form autocomplete="off" method="POST" action="{{ route('admin.subscription.payment.store') }}">
       {{ csrf_field() }}
      <div class="modal-body">
      
          <div class="form-group">
            <label for="name" class="col-form-label">@lang('labels.backend.access.payment.table.user'):</label>
            <select type="text" name="user" class="form-control select2" id="user" required>
                <option value="">@lang('labels.general.select_option')</option>
                @foreach($users as $user)
                    {{--<option value="{{$user->all}}" {{ old('user') ? 'selected' : '' }}>{{$user->all()}}</option>--}}
                    <option value="{{$user->id}}" {{ old('user') ? 'selected' : '' }}>{{$user->name}}</option>
                @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="name" class="col-form-label">@lang('labels.backend.access.payment.table.start'):</label>
            <input type="date" value="<?php echo date('Y-m-d'); ?>"  class="form-control" name="start" id="start" required>
          </div>

          <div class="form-group">
            <label for="name" class="col-form-label">@lang('labels.backend.access.payment.table.end'):</label>
            <input type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" name="end" id="end" required>
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
        $(function () {
          $('[data-toggle="popover"]').popover()
        })
       </script>
@endpush

