@extends('backend.layouts.app')

@section('title', __('labels.backend.access.users.management') . ' | ' . __('labels.backend.access.users.create'))

@section('breadcrumb-links')
    @include('backend.customer.includes.breadcrumb-links')
@endsection

@section('content')
    {{ html()->form('POST', route('admin.customer.store'))->class('form-horizontal')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            @lang('labels.backend.access.users.management')
                            <small class="text-muted">@lang('labels.backend.access.users.create')</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.users.first_name'))->class('col-md-2 form-control-label')->for('first_name') }}

                            <div class="col-md-10">
                                {{ html()->text('first_name')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.users.first_name'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.users.last_name'))->class('col-md-2 form-control-label')->for('last_name') }}

                            <div class="col-md-10">
                                {{ html()->text('last_name')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.users.last_name'))
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.users.email'))->class('col-md-2 form-control-label')->for('email') }}

                            <div class="col-md-10">
                                {{ html()->email('email')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.users.email'))
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.users.password'))->class('col-md-2 form-control-label')->for('password') }}

                            <div class="col-md-10">
                                {{ html()->password('password')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.users.password'))
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.users.password_confirmation'))->class('col-md-2 form-control-label')->for('password_confirmation') }}

                            <div class="col-md-10">
                                {{ html()->password('password_confirmation')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.users.password_confirmation'))
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.users.phone'))->class('col-md-2 form-control-label')->for('phone') }}

                            <div class="col-md-10">
                                {{ html()->text('phone')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.users.phone'))
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.users.birthdate'))->class('col-md-2 form-control-label')->for('age') }}
                            <div class="col-md-10">
                               {{-- Carbon::today()->toDateString() --}}
                                {{ html()->date('age')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.users.birthdate'))
                                    ->attribute('maxlength', 3)
                                     }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.users.address'))->class('col-md-2 form-control-label')->for('address') }}
                            <div class="col-md-10">
                                {{ html()->text('address')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.users.address'))
                                    ->attribute('maxlength', 191)
                                     }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.users.blood'))->class('col-md-2 form-control-label')->for('blood') }}
                            <div class="col-md-10">
                                <select name="blood" class="form-control">
                                    <option value="">Selecciona una opción</option>
                                    @foreach($bloods as $blood)
                                        {{ html()->option($blood->name, $blood->id, old('blood') ? 'selected' : '')
                                        }}
                                    @endforeach
                                </select>
                            </div><!--col-->
                        </div><!--form-group-->


                        <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.users.school'))->class('col-md-2 form-control-label')->for('school') }}
                            <div class="col-md-10">
                                {{ html()->select('school')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.users.phone'))
                                    ->attribute('maxlength', 191)
                                }}
                            </div><!--col-->
                        </div><!--form-group-->


                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.users.grade'))->class('col-md-2 form-control-label')->for('grade') }}
                            <div class="col-md-10">
                                {{ html()->text('grade')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.users.grade'))
                                    ->attribute('maxlength', 191)
                                }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.users.ins'))->class('col-md-2 form-control-label')->for('ins') }}
                            <div class="col-md-10">
                                {{ html()->text('ins')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.users.ins'))
                                    ->attribute('maxlength', 191)
                                }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.users.active'))->class('col-md-2 form-control-label')->for('active') }}

                            <div class="col-md-10">
                                <label class="switch switch-label switch-pill switch-primary">
                                    {{ html()->checkbox('active', true)->class('switch-input') }}
                                    <span class="switch-slider" data-checked="yes" data-unchecked="no"></span>
                                </label>
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.users.confirmed'))->class('col-md-2 form-control-label')->for('confirmed') }}

                            <div class="col-md-10">
                                <label class="switch switch-label switch-pill switch-primary">
                                    {{ html()->checkbox('confirmed', true)->class('switch-input') }}
                                    <span class="switch-slider" data-checked="yes" data-unchecked="no"></span>
                                </label>
                            </div><!--col-->
                        </div><!--form-group-->

                        @if(! config('access.users.requires_approval'))
                            <div class="form-group row">
                                {{ html()->label(__('validation.attributes.backend.access.users.send_confirmation_email') . '<br/>' . '<small>' .  __('strings.backend.access.users.if_confirmed_off') . '</small>')->class('col-md-2 form-control-label')->for('confirmation_email') }}

                                <div class="col-md-10">
                                    <label class="switch switch-label switch-pill switch-primary">
                                        {{ html()->checkbox('confirmation_email')->class('switch-input') }}
                                        <span class="switch-slider" data-checked="yes" data-unchecked="no"></span>
                                    </label>
                                </div><!--col-->
                            </div><!--form-group-->
                        @endif

                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.auth.user.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.create')) }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}
@endsection


@push('after-scripts')
<script>
    $(document).ready(function() {
        $('#school').select2({
          ajax: {
                url: '{{ route('admin.setting.school.select') }}',
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
            placeholder: '@lang('labels.backend.access.users.school')',
            width: 'resolve'
          });
    });
</script>
@endpush