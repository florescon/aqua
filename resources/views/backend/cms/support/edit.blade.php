@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.cms_support.edit'))


@section('content')

<div class="card">
  <div class="card-header">
    {{ $page->page_title }}
  </div>
  <div class="card-body">
    <form method="POST" action="{{ route('admin.cms.support.update', $page->id) }}">
    @method('PUT')
    @csrf

          <div class="form-group">
            <label for="name" class="col-form-label">@lang('labels.backend.access.cms_support.table.title')<sup>*</sup></label>
            <input type="text" class="form-control" name="page_title" value="{{ old('page_title', $page->page_title) }}" required>
          </div>

          <div class="form-group">
            <label for="body">@lang('labels.backend.access.cms_support.table.content')</label>
            <textarea class="form-control" id="body" name="content" rows="3">{{ old('content', $page->content) }}</textarea>
          </div>

          <div class="form-group">
            <label for="name" class="col-form-label">@lang('labels.backend.access.cms_support.table.meta_title')<sup>*</sup></label>
            <input type="text" class="form-control" name="meta_title" value="{{ old('meta_title', $page->meta_title) }}" required>
          </div>

          <div class="form-group">
            <label for="body">@lang('labels.backend.access.cms_support.table.meta_keywords')</label>
            <textarea class="form-control" id="m_keywords" name="meta_keywords" rows="3">{{  old('meta_keywords', $page->meta_keywords) }}</textarea>
          </div>

          <div class="form-group">
            <label for="body">@lang('labels.backend.access.cms_support.table.meta_description')</label>
            <textarea class="form-control" id="m_description" name="meta_description" rows="3">{{ old('meta_description', $page->meta_description) }}</textarea>
          </div>
          <button type="submit" class="btn btn-primary">@lang('labels.general.buttons.update')</button>
    </form>
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