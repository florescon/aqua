@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.cms_schedule.management'))

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.cms_schedule.management') }}
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
      				<div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
      				    <a href="#" data-toggle="modal" class="btn btn-success ml-1" title="@lang('labels.general.create_new')" data-target="#exampleModal"><i class="fas fa-plus-circle"></i></a>
      				</div><!--btn-toolbar-->
              @if($calendar->count())
              <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                  <a href="{{ route('frontend.schedule') }}" target="_blank" class="btn btn-info ml-1">Ver horario <i class="fas fa-eye"></i></a>
              </div><!--btn-toolbar-->
              @endif
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-striped data-table">
                        <thead>
                        <tr>
                            <th>@lang('labels.backend.access.cms_schedule.table.schedule')</th>
                            <th>@lang('labels.backend.access.cms_schedule.table.mon')</th>
                            <th>@lang('labels.backend.access.cms_schedule.table.tue')</th>
                            <th>@lang('labels.backend.access.cms_schedule.table.wed')</th>
                            <th>@lang('labels.backend.access.cms_schedule.table.thu')</th>
                            <th>@lang('labels.backend.access.cms_schedule.table.fri')</th>
                            <th>@lang('labels.backend.access.cms_schedule.table.sat')</th>
                            <th>@lang('labels.general.actions') </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($calendar as $cal)
                            <tr>
                                <td>{{ $cal->schedule }}</td>
                                <td>{{ $cal->mon }}</td>
                                <td>{{ $cal->tue }}</td>
                                <td>{{ $cal->wed }}</td>
                                <td>{{ $cal->thu }}</td>
                                <td>{{ $cal->fri }}</td>
                                <td>{{ $cal->sat }}</td>
                                <td> 
                                <div class="btn-group" role="group" aria-label="_{{ _('labels.backend.access.users.user_actions') }}">

                                    <a href="#" data-toggle="modal" data-placement="top" title="{{ __('buttons.general.crud.edit') }}" class="btn btn-primary" data-id="{{ $cal->id }}" data-schedule="{{ $cal->schedule }}" data-mon="{{ $cal->mon }}" data-tue="{{ $cal->tue }}" data-wed="{{ $cal->wed }}" data-thu="{{ $cal->thu }}" data-fri="{{ $cal->fri }}"  data-sat="{{ $cal->sat }}" data-sort="{{ $cal->sort }}" data-target="#editSchedule"><i class="fas fa-edit"></i></a>

    								<a href="{{ route('admin.cms.schedule.destroy', $cal->id) }}" class="btn btn-danger" data-method="delete" data-trans-button-cancel="{{ __('buttons.general.cancel') }}" data-trans-button-confirm="{{ __('buttons.general.crud.delete') }}" data-trans-title="{{ __('strings.backend.general.are_you_sure') }}" class="dropdown-item">
                    									<i class="fas fa-eraser"></i>
                    								</a>
                                </div>
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
                    {!! $calendar->total() !!} {{ trans_choice('labels.backend.access.cms_schedule.table.total', $calendar->total()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {{ $calendar->links() }}
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
        <h5 class="modal-title" id="exampleModalLabel">@lang('labels.backend.access.cms_schedule.create')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    <form autocomplete="off" method="POST" action="{{ route('admin.cms.schedule.store') }}">
       @csrf
      <div class="modal-body">
          <div class="form-group">
            <label for="schedule" class="col-form-label">@lang('labels.backend.access.cms_schedule.table.schedule'):</label>
            <input type="text" class="form-control" name="schedule" id="schedule" required>
          </div>

          <div class="form-group">
            <label for="mon" class="col-form-label">@lang('labels.backend.access.cms_schedule.table.mon'):</label>
            <input type="text" class="form-control" value="" name="mon" id="mon" required>
          </div>
          <div class="form-group">
            <label for="tue" class="col-form-label">@lang('labels.backend.access.cms_schedule.table.tue'):</label>
            <input type="text" class="form-control" value="" name="tue" id="tue" required>
          </div>
          <div class="form-group">
            <label for="wed" class="col-form-label">@lang('labels.backend.access.cms_schedule.table.wed'):</label>
            <input type="text" class="form-control" value="" name="wed" id="wed" required>
          </div>
          <div class="form-group">
            <label for="thu" class="col-form-label">@lang('labels.backend.access.cms_schedule.table.thu'):</label>
            <input type="text" class="form-control" value="" name="thu" id="thu" required>
          </div>
          <div class="form-group">
            <label for="fri" class="col-form-label">@lang('labels.backend.access.cms_schedule.table.fri'):</label>
            <input type="text" class="form-control" value="" name="fri" id="fri" required>
          </div>
          <div class="form-group">
            <label for="sat" class="col-form-label">@lang('labels.backend.access.cms_schedule.table.sat'):</label>
            <input type="text" class="form-control" value="" name="sat" id="sat" required>
          </div>
          <div class="form-group">
            <label for="sort" class="col-form-label">@lang('labels.backend.access.cms_schedule.table.sort'):</label>
            <input type="number" max="250" class="form-control" name="sort" id="sort" required>
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


<!-- Edit Modal -->
<div class="modal fade" id="editSchedule" tabindex="-1" role="dialog" aria-labelledby="editScheduleLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editScheduleLabel">@lang('labels.backend.access.cms_schedule.edit')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    <form autocomplete="off" method="POST" action="{{ route('admin.cms.schedule.update', 'test') }}">
        {{method_field('patch')}}
        @csrf
      <div class="modal-body">
          <div class="form-group">
            <label for="schedule" class="col-form-label">@lang('labels.backend.access.cms_schedule.table.schedule'):</label>
            <input type="hidden" name="id" id="id" value="">
            <input type="text" class="form-control" value="" name="schedule" id="schedule" required>
          </div>

          <div class="form-group">
            <label for="mon" class="col-form-label">@lang('labels.backend.access.cms_schedule.table.mon'):</label>
            <input type="text" class="form-control" value="" name="mon" id="mon" required>
          </div>
          <div class="form-group">
            <label for="tue" class="col-form-label">@lang('labels.backend.access.cms_schedule.table.tue'):</label>
            <input type="text" class="form-control" value="" name="tue" id="tue" required>
          </div>
          <div class="form-group">
            <label for="wed" class="col-form-label">@lang('labels.backend.access.cms_schedule.table.wed'):</label>
            <input type="text" class="form-control" value="" name="wed" id="wed" required>
          </div>
          <div class="form-group">
            <label for="thu" class="col-form-label">@lang('labels.backend.access.cms_schedule.table.thu'):</label>
            <input type="text" class="form-control" value="" name="thu" id="thu" required>
          </div>
          <div class="form-group">
            <label for="fri" class="col-form-label">@lang('labels.backend.access.cms_schedule.table.fri'):</label>
            <input type="text" class="form-control" value="" name="fri" id="fri" required>
          </div>
          <div class="form-group">
            <label for="sat" class="col-form-label">@lang('labels.backend.access.cms_schedule.table.sat'):</label>
            <input type="text" class="form-control" value="" name="sat" id="sat" required>
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
    $('#editSchedule').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var id = button.data('id')
      var schedule = button.data('schedule')
      var mon = button.data('mon')
      var tue = button.data('tue')
      var wed = button.data('wed')
      var thu = button.data('thu')
      var fri = button.data('fri')
      var sat = button.data('sat')
      var sort = button.data('sort')

      var modal = $(this)


      modal.find('.modal-body #schedule').val(schedule)
      modal.find('.modal-body #mon').val(mon)
      modal.find('.modal-body #tue').val(tue)
      modal.find('.modal-body #wed').val(wed)
      modal.find('.modal-body #thu').val(thu)
      modal.find('.modal-body #fri').val(fri)
      modal.find('.modal-body #sat').val(sat)
      modal.find('.modal-body #sort').val(sort)
      modal.find('.modal-body #id').val(id)
    })
</script>
@endpush