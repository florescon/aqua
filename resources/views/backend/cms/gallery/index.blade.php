@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.cms_gallery.management'))


@section('content')

<div class="card">

    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.cms_gallery.management') }}
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
				<div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
				    <a href="#" data-toggle="modal" class="btn btn-success ml-1" title="@lang('labels.general.create_new')" data-target="#createPicture"><i class="fas fa-plus-circle"></i></a>
				</div><!--btn-toolbar-->

            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>@lang('labels.backend.access.cms_gallery.table.title')</th>
                            <th>@lang('labels.backend.access.cms_gallery.table.image')</th>
                            <th>@lang('labels.backend.access.cms_gallery.table.sort')</th>
                            <th>@lang('labels.backend.access.cms_gallery.table.created')</th>
                            <th>@lang('labels.backend.access.cms_gallery.table.last_updated')</th>
                            <th>@lang('labels.general.actions') </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($gallery as $picture)
                            <tr>
                                <td>{{ $picture->title }}</td>
                                <td>
                                  @if(File::exists(public_path("/images/gallery/".$picture->image)))
                                    <a href="{{ asset('/images/gallery/' . $picture->image) }}" target="_blank"><img src="{{ asset('/images/gallery/' . $picture->image) }}" width="80px" alt="Image">
                                    </a>
                                  @else
                                  <button type="button" class="btn btn-sm btn-outline-danger">Sin imagen</button>
                                  @endif  
                                </td>
                                <td>{{ $picture->sort }}</td>
                                <td>{{ $picture->created_at->diffForHumans() }}</td>
                                <td>{{ $picture->updated_at->diffForHumans() }}</td>
                                <td> 
                                <div class="btn-group" role="group" aria-label="_{{ _('labels.backend.access.users.user_actions') }}">

                                    <a href="#" data-toggle="modal" data-placement="top" title="{{ __('buttons.general.crud.edit') }}" class="btn btn-primary" data-id="{{ $picture->id }}" data-myname="{{ $picture->title }}" data-myavatar="{{ $picture->avatar_type }}" data-mysort="{{ $picture->sort }}" data-target="#editModal"><i class="fas fa-edit"></i></a>

                    								<a href="{{ route('admin.cms.gallery.destroy', $picture->id) }}" class="btn btn-danger" data-method="delete" data-trans-button-cancel="{{ __('buttons.general.cancel') }}" data-trans-button-confirm="{{ __('buttons.general.crud.delete') }}" data-trans-title="{{ __('strings.backend.general.are_you_sure') }}" class="dropdown-item">
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
                    {!! $gallery->total() !!} {{ trans_choice('labels.backend.access.cms_gallery.table.total', $gallery->total()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {{ $gallery->links() }}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->



<!-- Modal -->
<div class="modal fade" id="createPicture" tabindex="-1" role="dialog" aria-labelledby="createPictureLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createPictureLabel">@lang('labels.backend.access.cms_gallery.create')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    <form autocomplete="off" method="POST" action="{{ route('admin.cms.gallery.store') }}" enctype="multipart/form-data">
       @csrf
      <div class="modal-body">
          <div class="form-group">
            <label for="name" class="col-form-label">@lang('labels.backend.access.cms_gallery.table.title')<sup>*</sup></label>
            <input type="text" class="form-control" name="title" id="title" required>
          </div>
          <div class="form-group">
              <label for="image" class="col-form-label">@lang('labels.backend.access.cms_gallery.image_upload')<sup>*</sup></label>
                  <div class="custom-file">
                      <input type="file" name="image" class="custom-file-input">
                      <label class="custom-file-label">@lang('labels.backend.access.cms_gallery.choose_file')</label>
                  </div>
          </div>
          <div class="form-group">
            <label for="sort" class="col-form-label">@lang('labels.backend.access.cms_gallery.table.sort')</label>
            <input type="number" class="form-control" name="sort" id="sort">
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
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">@lang('labels.backend.access.cms_gallery.edit')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    <form autocomplete="off" method="POST" action="{{ route('admin.setting.school.update', 'test') }}" enctype="multipart/form-data">
        {{method_field('patch')}}
        @csrf
      <div class="modal-body">
          <div class="form-group">
            <label for="name" class="col-form-label">@lang('labels.backend.access.cms_gallery.table.title'):</label>
            <input type="hidden" name="id" id="id" value="">
            <input type="text" class="form-control" value="" name="name" id="name" required>
          </div>



          {{-- <div class="form-group">
            <img name="avatar" id="avatar" width="160px" alt="Image">
          </div> --}}

          <div class="form-group">
              <label for="imagen" class="col-form-label">@lang('labels.backend.access.cms_gallery.change_image')</label>
                  <div class="custom-file">
                      <input type="file" name="image" class="custom-file-input">
                      <label class="custom-file-label">@lang('labels.backend.access.cms_gallery.choose_file')</label>
                  </div>
          </div>
          <div class="form-group">
            <label for="sort" class="col-form-label">@lang('labels.backend.access.cms_gallery.table.sort'):</label>
            <input type="text" class="form-control" value="" name="sort" id="sort" required>
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
      var avatar = button.data('myavatar')
      var sort = button.data('mysort')
      var id = button.data('id')
      var modal = $(this)


      modal.find('.modal-body #name').val(name)
      modal.find('.modal-body #avatar').attr("src","{{asset('/images/gallery/')}}"+'/'+avatar)
      modal.find('.modal-body #sort').val(sort)
      modal.find('.modal-body #id').val(id)
    })
</script>
@endpush