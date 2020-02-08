@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.section.management'))

@push('after-styles')
    <link  href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.section.management') }}
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
                    <table class="table table-striped data-table">
                        <thead>
                        <tr>
                            <th>@lang('labels.backend.access.section.table.id')</th>
                            <th>@lang('labels.backend.access.section.table.name')</th>
                            <th>@lang('labels.backend.access.section.table.created')</th>
                            <th>@lang('labels.backend.access.section.table.last_updated')</th>
                            <th>@lang('labels.general.actions') </th>
                        </tr>
                        </thead>
                        {{-- <tbody>
                        @foreach($sections as $section)
                            <tr>
                                <td>{{ $section->name }}</td>
                                <td>{{ $section->created_at->diffForHumans() }}</td>
                                <td>{{ $section->updated_at->diffForHumans() }}</td>
                                <td> 
                                <div class="btn-group" role="group" aria-label="_{{ _('labels.backend.access.users.user_actions') }}">

                                    <a href="#" data-toggle="modal" data-placement="top" title="{{ __('buttons.general.crud.edit') }}" class="btn btn-primary" data-id="{{ $section->id }}" data-myname="{{ $section->name }}" data-target="#editSection"><i class="fas fa-edit"></i></a>

                    								<a href="{{ route('admin.class.section.destroy', $section->id) }}" class="btn btn-danger" data-method="delete" data-trans-button-cancel="{{ __('buttons.general.cancel') }}" data-trans-button-confirm="{{ __('buttons.general.crud.delete') }}" data-trans-title="{{ __('strings.backend.general.are_you_sure') }}" class="dropdown-item">
                    									<i class="fas fa-eraser"></i>
                    								</a>
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
                    {{-- {!! $sections->total() !!} {{ trans_choice('labels.backend.access.section.table.total', $sections->total()) }} --}}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {{-- {{ $sections->links() }} --}}
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
        <h5 class="modal-title" id="exampleModalLabel">@lang('labels.backend.access.section.create')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    <form autocomplete="off" method="POST" action="{{ route('admin.class.section.store') }}">
       @csrf
      <div class="modal-body">
          <div class="form-group">
            <label for="name" class="col-form-label">@lang('labels.backend.access.section.table.name'):</label>
            <input type="text" class="form-control" name="name" id="name" required>
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
<div class="modal fade" id="editSection" tabindex="-1" role="dialog" aria-labelledby="editSectionLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editSectionLabel">@lang('labels.backend.access.section.edit')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    <form autocomplete="off" method="POST" action="{{ route('admin.class.section.update', 'test') }}">
        {{method_field('patch')}}
        @csrf
      <div class="modal-body">
          <div class="form-group">

            <label for="name" class="col-form-label">@lang('labels.backend.access.section.table.name'):</label>
            <input type="hidden" name="id" id="id" value="">
            <input type="text" class="form-control" value="" name="name" id="name" required>
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
    $('#editSection').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var name = button.data('myname')
      var id = button.data('id')
      var modal = $(this)


      modal.find('.modal-body #name').val(name)
      modal.find('.modal-body #id').val(id)
    });


    $(function () {
      var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.class.section.index') }}",
        language: {
          "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
        },
        order: ['3', 'desc'], 
        columnDefs: [
            {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            }        
        ],
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
      });
    
    });

</script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
@endpush