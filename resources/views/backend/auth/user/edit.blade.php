@extends('backend.layouts.app')

@section('title', __('labels.backend.access.users.management') . ' | ' . __('labels.backend.access.users.edit'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->modelForm($user, 'PATCH', route('admin.auth.user.update', $user->id))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.access.users.management')
                        <small class="text-muted">@lang('labels.backend.access.users.edit')</small>
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
                                ->required() }}
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
                        {{ html()->label(__('validation.attributes.backend.access.users.phone'))->class('col-md-2 form-control-label')->for('phone') }}

                        <div class="col-md-10">
                            {{ html()->text('phone', optional($user->customer)->phone)
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.users.phone'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->
 
                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.users.birthdate'))->class('col-md-2 form-control-label')->for('age') }}

                        <div class="col-md-10">
                            {{ html()->date('age', optional($user->customer)->age)
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.users.birthdate'))
                                ->attribute('maxlength', 3)
                                 }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.users.address'))->class('col-md-2 form-control-label')->for('address') }}

                        <div class="col-md-10">
                            {{ html()->text('address', optional($user->customer)->address)
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
                                {{ html()->option($blood->name, $blood->id, $blood->id==optional($user->customer)->blood_id ? 'selected' : '')
                                }}
                            @endforeach
                        </select>
                        </div><!--col-->
                    </div><!--form-group-->



                   <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.access.users.school'))->class('col-md-2 form-control-label')->for('school') }}

                        <div class="col-md-10">
                        <select name="school" class="form-control">
                            <option value="">Selecciona una opción</option>
                            @foreach($schools as $school)
                                {{ html()->option($school->name, $school->id, $school->id==optional($user->customer)->school_id ? 'selected' : '')
                                }}
                            @endforeach
                        </select>
                        </div><!--col-->
                    </div><!--form-group-->


                    <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.access.users.grade'))->class('col-md-2 form-control-label')->for('grade') }}

                        <div class="col-md-10">
                            {{ html()->text('grade', optional($user->customer)->grade)
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.users.grade'))
                                ->attribute('maxlength', 191)
                            }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.access.users.ins'))->class('col-md-2 form-control-label')->for('ins') }}

                        <div class="col-md-10">
                            {{ html()->text('ins', optional($user->customer)->ins)
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.users.ins'))
                                ->attribute('maxlength', 191)
                            }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label('Abilities')->class('col-md-2 form-control-label') }}

                        <div class="table-responsive col-md-10">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>@lang('labels.backend.access.users.table.roles')</th>
                                        <th>@lang('labels.backend.access.users.table.permissions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            @if($roles->count())
                                                @foreach($roles as $role)
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <div class="checkbox d-flex align-items-center">
                                                                {{ html()->label(
                                                                        html()->checkbox('roles[]', in_array($role->name, $userRoles), $role->name)
                                                                                ->class('switch-input')
                                                                                ->id('role-'.$role->id)
                                                                        . '<span class="switch-slider" data-checked="on" data-unchecked="off"></span>')
                                                                    ->class('switch switch-label switch-pill switch-primary mr-2')
                                                                    ->for('role-'.$role->id) }}
                                                                {{ html()->label(ucwords($role->name))->for('role-'.$role->id) }}
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            @if($role->id != 1)
                                                                @if($role->permissions->count())
                                                                    @foreach($role->permissions as $permission)
                                                                        <i class="fas fa-dot-circle"></i> {{ ucwords($permission->name) }}
                                                                    @endforeach
                                                                @else
                                                                    <span class="badge badge-secondary">@lang('labels.general.none')</span>
                                                                @endif
                                                            @else
                                                                <span class="badge badge-secondary">@lang('labels.backend.access.users.all_permissions')</span>
                                                            @endif
                                                        </div>
                                                    </div><!--card-->
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if($permissions->count())
                                                @foreach($permissions as $permission)
                                                    <div class="checkbox d-flex align-items-center">
                                                        {{ html()->label(
                                                                html()->checkbox('permissions[]', in_array($permission->name, $userPermissions), $permission->name)
                                                                        ->class('switch-input')
                                                                        ->id('permission-'.$permission->id)
                                                                    . '<span class="switch-slider" data-checked="on" data-unchecked="off"></span>')
                                                                ->class('switch switch-label switch-pill switch-primary mr-2')
                                                            ->for('permission-'.$permission->id) }}
                                                        {{ html()->label(ucwords($permission->name))->for('permission-'.$permission->id) }}
                                                    </div>
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div><!--col-->
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.auth.user.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
@endsection
