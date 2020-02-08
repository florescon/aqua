@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.school.management'))

@push('after-styles')
    <link  href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="//cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
@endpush

@section('content')

<div class="card" style="border: 1px solid blue;">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.school.management') }}
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
                    <table class="table table-striped data-table" style="width:100%">
                        <thead>
                        <tr>
                            <th>@lang('labels.backend.access.school.table.id')</th>
                            <th>@lang('labels.backend.access.school.table.name')</th>
                            <th>@lang('labels.backend.access.school.table.image')</th>
                            <th>@lang('labels.backend.access.school.table.address')</th>
                            <th>@lang('labels.backend.access.school.table.created')</th>
                            <th>@lang('labels.backend.access.school.table.last_updated')</th>
                            <th>@lang('labels.general.actions') </th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                            <th>@lang('labels.backend.access.school.table.id')</th>
                            <th>@lang('labels.backend.access.school.table.name')</th>
                            <th>@lang('labels.backend.access.school.table.image')</th>
                            <th>@lang('labels.backend.access.school.table.address')</th>
                            <th>@lang('labels.backend.access.school.table.created')</th>
                            <th>@lang('labels.backend.access.school.table.last_updated')</th>
                            <th>@lang('labels.general.actions') </th>
                        </tfoot>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {{-- {!! $schools->total() !!} {{ trans_choice('labels.backend.access.school.table.total', $schools->total()) }} --}}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {{-- {{ $schools->links() }} --}}
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
        <h5 class="modal-title" id="exampleModalLabel">@lang('labels.backend.access.school.create')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    <form autocomplete="off" method="POST" action="{{ route('admin.setting.school.store') }}" enctype="multipart/form-data">
       @csrf
      <div class="modal-body">
          <div class="form-group">
            <label for="name" class="col-form-label">@lang('labels.backend.access.school.table.name')<sup>*</sup></label>
            <input type="text" class="form-control" name="name" id="name" required>
          </div>

          <div class="form-group">
            <label for="address" class="col-form-label">@lang('labels.backend.access.school.table.address')<sup>*</sup></label>
            <input type="text" class="form-control" name="address" id="address" required>
          </div>

          <div class="form-group">
              <label for="imagen" class="col-form-label">@lang('labels.backend.access.school.image_upload')</label>
                  <div class="custom-file">
                      <input type="file" name="image" class="custom-file-input">
                      <label class="custom-file-label">@lang('labels.backend.access.school.choose_file')</label>
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


<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">@lang('labels.backend.access.school.edit')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    <form autocomplete="off" method="POST" action="{{ route('admin.setting.school.update', 'test') }}" enctype="multipart/form-data">
        {{method_field('patch')}}
        @csrf
      <div class="modal-body">
          <div class="form-group">
            <label for="name" class="col-form-label">@lang('labels.backend.access.school.table.name'):</label>
            <input type="hidden" name="id" id="id" value="">
            <input type="text" class="form-control" value="" name="name" id="name" required>
          </div>

          <div class="form-group">
            <label for="address" class="col-form-label">@lang('labels.backend.access.school.table.address'):</label>
            <input type="text" class="form-control" value="" name="address" id="address" required>
          </div>


          {{-- <div class="form-group">
            <img name="avatar" id="avatar" width="160px" alt="Image">
          </div> --}}

          <div class="form-group">
              <label for="imagen" class="col-form-label">@lang('labels.backend.access.school.image_upload')</label>
                  <div class="custom-file">
                      <input type="file" name="image" class="custom-file-input">
                      <label class="custom-file-label">@lang('labels.backend.access.school.choose_file')</label>
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
    $('#editModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var name = button.data('myname')
      var address = button.data('myaddress')
      var avatar = button.data('myavatar')
      var id = button.data('id')
      var modal = $(this)


      modal.find('.modal-body #name').val(name)
      modal.find('.modal-body #address').val(address)
      modal.find('.modal-body #avatar').attr("src","{{asset('/images/')}}"+'/'+avatar)
      modal.find('.modal-body #id').val(id)
    });


    $(function () {
    
      var table = $('.data-table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.setting.school.index') }}",
        language: {
          "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
        },
        order: ['4', 'desc'], 
        columnDefs: [
            {
                "targets": [0],
                "visible": false,
                "searchable": false
            },
            { // image
                'targets': 2,
                'searchable': false,
                'orderable': false,
                'render': function (data, type, full_row, meta){
                    if(full_row.avatar_type!='gravatar'){
                      return '<a href="{{ asset('/images') }}/' + full_row.avatar_type + '" target="_blank"><img src="{{ asset('/images') }}/' + full_row.avatar_type + '" width="80px" target="_blank"/></a>';
                    } else {
                        return '<span class="badge badge-pill badge-danger"> <em>No imagen</em></span>';
                    }
                }
            }
        ],
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'avatar_type', name: 'avatar_type'},
            {data: 'address', name: 'address'},
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
      });
    
    });

</script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
@endpush