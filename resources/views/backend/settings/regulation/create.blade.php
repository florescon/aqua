@extends('backend.layouts.app')

@section('title', __('labels.backend.access.regulation.management') . ' | ' . __('labels.backend.access.regulation.create'))

@section('content')
{{ html()->form('POST', route('admin.setting.regulation.store'))->class('form-horizontal')->open() }}

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.regulation.management') }}
                        <small class="text-muted">@lang('labels.backend.access.regulation.create')</small>
                    </h4>
                </div><!--col-->
            </div>
            <hr>
            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.regulation.title'))->class('col-md-2 form-control-label')->for('title') }}

                        <div class="col-md-10">
                            {{ html()->text('title')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.regulation.title'))
                                ->attribute('maxlength', 191)
                                ->required()
                                ->autofocus() }}
                        </div><!--col-->
                    </div><!--form-group-->


                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.regulation.body'))->class('col-md-2 form-control-label')->for('body') }}

                        <div class="col-md-10">
                            {{ html()->textarea('body')
                                ->class('form-control')
                                ->id('body')
                                ->name('body')
                                ->attribute('maxlength', 191)
                                ->required()
                                ->autofocus() }}
                        </div><!--col-->
                    </div><!--form-group-->

                </div>
    		</div>	
    	</div>
        <div class="card-footer clearfix">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.setting.regulation.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.create')) }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div>

{{ html()->form()->close() }}
@endsection
