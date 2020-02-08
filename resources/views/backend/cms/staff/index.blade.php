@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.school.management'))

@section('content')

<div class="card">

    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.cms_staff.management') }}
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
                            <th>@lang('labels.backend.access.cms_staff.table.name')</th>
                            <th>@lang('labels.backend.access.cms_staff.table.image')</th>
                            <th>@lang('labels.backend.access.cms_staff.table.job')</th>
                            <th>@lang('labels.backend.access.cms_staff.table.created')</th>
                            <th>@lang('labels.backend.access.cms_staff.table.last_updated')</th>
                            <th>@lang('labels.general.actions') </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($staff as $sta)
                            <tr>
                                <td>{{ $sta->name }}</td>
                                <td>
                                  @if(File::exists(public_path("/images/staff/".$sta->image)))
                                    <a href="{{ asset('/images/staff/' . $sta->image) }}" target="_blank"><img src="{{ asset('/images/staff/' . $sta->image) }}" width="80px" alt="Image">
                                    </a>
                                  @else
                                  <button type="button" class="btn btn-sm btn-outline-danger">Sin imagen</button>
                                  @endif  
                                </td>
                                <td>{{ $sta->job }}</td>
                                <td>{{ $sta->created_at->diffForHumans() }}</td>
                                <td>{{ $sta->updated_at->diffForHumans() }}</td>
                                <td> 
                                <div class="btn-group" role="group" aria-label="_{{ _('labels.backend.access.users.user_actions') }}">

                                    <a href="#" data-toggle="modal" data-placement="top" title="{{ __('buttons.general.crud.edit') }}" class="btn btn-primary" data-id="{{ $sta->id }}" data-myname="{{ $sta->name }}"
                                    data-myaddress="{{ $sta->address }}" data-myavatar="{{ $sta->avatar_type }}" data-target="#editModal"><i class="fas fa-edit"></i></a>

                    								<a href="{{ route('admin.cms.staff.destroy', $sta->id) }}" class="btn btn-danger" data-method="delete" data-trans-button-cancel="{{ __('buttons.general.cancel') }}" data-trans-button-confirm="{{ __('buttons.general.crud.delete') }}" data-trans-title="{{ __('strings.backend.general.are_you_sure') }}" class="dropdown-item">
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
                    {!! $staff->total() !!} {{ trans_choice('labels.backend.access.cms_staff.table.total', $staff->total()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {{ $staff->links() }}
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
        <h5 class="modal-title" id="exampleModalLabel">@lang('labels.backend.access.cms_staff.create')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    <form autocomplete="off" autocomplete="off" method="POST" action="{{ route('admin.cms.staff.store') }}" enctype="multipart/form-data">
       @csrf
      <div class="modal-body">
          <div class="form-group">
            <label for="name" class="col-form-label">@lang('labels.backend.access.cms_staff.table.name')<sup>*</sup></label>
            <input type="text" class="form-control" name="name" id="name" required>
          </div>

          <div class="form-group">
            <label for="address" class="col-form-label">@lang('labels.backend.access.cms_staff.table.job')<sup>*</sup></label>
            <input type="text" class="form-control" name="address" id="address" required>
          </div>

          <div class="form-group">
              <label for="image" class="col-form-label">@lang('labels.backend.access.cms_staff.image_upload')<sup>*</sup></label>
                  <div class="custom-file">
                      <input type="file" name="image" class="custom-file-input">
                      <label class="custom-file-label">@lang('labels.backend.access.cms_staff.choose_file')...</label>
                  </div>
          </div>

          <div class="form-group row">
            <div class="col-md-12">
              <div class="input-group">
                <span class="input-group-prepend">
                  <button class="btn btn-primary" type="button">
                    <i class="fab fa-facebook"></i>
                  </button>
                </span>
                <input class="form-control" id="input3-group2" type="url" name="facebook" placeholder="Facebook">
              </div>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-12">
              <div class="input-group">
                <span class="input-group-prepend">
                  <button class="btn btn-primary" type="button">
                    <i class="fab fa-twitter"></i>
                  </button>
                </span>
                <input class="form-control" id="input3-group2" type="url" name="twitter" placeholder="Twitter">
              </div>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-12">
              <div class="input-group">
                <span class="input-group-prepend">
                  <button class="btn btn-primary" type="button">
                    <i class="fab fa-instagram"></i>
                  </button>
                </span>
                <input class="form-control" id="input3-group2" type="url" name="instagram" placeholder="Instagram">
              </div>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-12">
              <div class="input-group">
                <span class="input-group-prepend">
                  <button class="btn btn-primary" type="button">
                    <i class="fab fa-youtube"></i>
                  </button>
                </span>
                <input class="form-control" id="input3-group2" type="url" name="youtube" placeholder="Youtube">
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
      modal.find('.modal-body #avatar').attr("src","{{asset('/images/staff/')}}"+'/'+avatar)
      modal.find('.modal-body #id').val(id)
    })
</script>
@endpush