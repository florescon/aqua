@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.cms_page.management'))


@section('content')

<div class="card">

    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.cms_page.management') }}
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
				<div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
				    <a href="#" data-toggle="modal" class="btn btn-success ml-1" title="@lang('labels.general.create_new')" data-target="#createPage"><i class="fas fa-plus-circle"></i></a>
				</div><!--btn-toolbar-->

            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>@lang('labels.backend.access.cms_page.table.title')</th>
                            <th>@lang('labels.backend.access.cms_page.table.content')</th>
                            <th>@lang('labels.backend.access.cms_page.table.meta_title')</th>
                            <th>@lang('labels.backend.access.cms_page.table.meta_description')</th>
                            <th>@lang('labels.backend.access.cms_page.table.meta_keywords')</th>
                            <th>@lang('labels.general.actions') </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pages as $page)
                            <tr>
                                <td>{{ $page->page_title }}</td>
                                <td>
                                  {!! str_limit($page->content, 60) !!}
                                </td>
                                <td>{{ $page->meta_title }}</td>
                                <td>{!! str_limit($page->meta_description, 60) !!}</td>
                                <td>{!! str_limit($page->meta_keywords, 60) !!}</td>
                                <td> 
                                <div class="btn-group" role="group" aria-label="_{{ _('labels.backend.access.users.user_actions') }}">

                                    <a href="{{ route('admin.cms.pages.edit', $page->id) }}" data-placement="top" title="{{ __('buttons.general.crud.edit') }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>

    								<a href="{{ route('admin.cms.pages.destroy', $page->id) }}" class="btn btn-danger" data-method="delete" data-trans-button-cancel="{{ __('buttons.general.cancel') }}" data-trans-button-confirm="{{ __('buttons.general.crud.delete') }}" data-trans-title="{{ __('strings.backend.general.are_you_sure') }}" class="dropdown-item">
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
                    {!! $pages->total() !!} {{ trans_choice('labels.backend.access.cms_page.table.total', $pages->total()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {{ $pages->links() }}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->



<!-- Modal -->
<div class="modal fade" id="createPage" tabindex="-1" role="dialog" aria-labelledby="createPageLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createPageLabel">@lang('labels.backend.access.cms_page.create')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    <form autocomplete="off" method="POST" action="{{ route('admin.cms.pages.store') }}">
       @csrf
      <div class="modal-body">
          <div class="form-group">
            <label for="name" class="col-form-label">@lang('labels.backend.access.cms_page.table.title')<sup>*</sup></label>
            <input type="text" class="form-control" name="title" id="title" required>
          </div>

          <div class="form-group">
            <label for="body">@lang('labels.backend.access.cms_page.table.content')</label>
            <textarea class="form-control" id="body" name="content" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label for="name" class="col-form-label">@lang('labels.backend.access.cms_page.table.meta_title')<sup>*</sup></label>
            <input type="text" class="form-control" name="m_title" id="m_title" required>
          </div>

          <div class="form-group">
            <label for="body">@lang('labels.backend.access.cms_page.table.meta_keywords')</label>
            <textarea class="form-control" id="m_keywords" name="m_keywords" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label for="body">@lang('labels.backend.access.cms_page.table.meta_description')</label>
            <textarea class="form-control" id="m_description" name="m_description" rows="3"></textarea>
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
    CKEDITOR.replace( 'body',{
    language: 'es',
    // uiColor: '#9AB8F3'

    });
    CKEDITOR.config.height = 500;

</script>
@endpush