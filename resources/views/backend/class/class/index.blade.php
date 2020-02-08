@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.class.management'))

@section('content')

<div class="card">

    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.class.management') }}
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
				<div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
				    <a href="#" data-toggle="modal" class="btn btn-success ml-1" title="@lang('labels.general.create_new')" data-target="#createClass"><i class="fas fa-plus-circle"></i></a>
				</div><!--btn-toolbar-->

            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>@lang('labels.backend.access.class.table.name')</th>
                            <th>@lang('labels.backend.access.class.table.section')</th>
                            <th>@lang('labels.backend.access.class.table.classroom_type')</th>
                            <th>@lang('labels.backend.access.class.table.instructor')</th>
                            <th>@lang('labels.backend.access.class.table.student')</th>
                            <th>@lang('labels.backend.access.class.table.schedule')</th>
                            <th>@lang('labels.general.actions') </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($classes as $class)
                            <tr>
                                <td>{{ $class->name }}</td>
                                <td>{!! !empty($class->sections) ? $class->sections->name :'<button class="btn btn-default btn-sm"><i class="far fa-sad-cry"></i></button>' !!}</td>
                               <td>{!! !empty($class->classtype) ? '<button type="button" class="btn btn-sm btn-outline-dark">'. $class->classtype->name .'</button>' :'<button class="btn btn-default btn-sm"><i class="far fa-sad-cry"></i></button>' !!}</td>
                                <td>{!! !empty($class->users) ? '<button type="button" class="btn btn-sm btn-outline-warning">'.$class->users->name.'</button>' :'<button class="btn btn-default btn-sm"><i class="far fa-sad-cry"></i></button>' !!}</td>
                                <td> 

                                @foreach($class->students as $student)
                                    <button type="button" class="btn btn-sm btn-outline-dark">
                                      {{ $student->name }}
                                    </button>                                    
                                @endforeach

                                </td>
                                <td>{{ Carbon::parse($class->schedule)->format('h:i a')}}</td>
                                <td> 
                                <div class="btn-group" role="group" aria-label="_{{ _('labels.backend.access.users.user_actions') }}">

                                    <a href="#" data-toggle="modal" data-placement="top" title="{{ __('buttons.general.crud.edit') }}" class="btn btn-primary" data-id="{{ $class->id }}" data-myname="{{ $class->name }}" data-target="#editClass"><i class="fas fa-edit"></i></a>

        							<a href="{{ route('admin.class.class.destroy', $class->id) }}" class="btn btn-danger" data-method="delete" data-trans-button-cancel="@lang('buttons.general.cancel')" data-trans-button-confirm="@lang('buttons.general.crud.delete')" data-trans-title="@lang('strings.backend.general.are_you_sure')" class="dropdown-item">
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
                  {!! $classes->total() !!} {{ trans_choice('labels.backend.access.class.table.total', $classes->total()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {{ $classes->links() }}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->



<!-- Modal -->
<div class="modal fade" id="createClass" tabindex="-1" role="dialog" aria-labelledby="createClassLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createClassLabel">@lang('labels.backend.access.class.create')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    <form autocomplete="off" method="POST" action="{{ route('admin.class.class.store') }}">
       @csrf
      <div class="modal-body">
          <div class="form-group">
            <label for="name" class="col-form-label">@lang('labels.backend.access.class.table.name'):</label>
            <input type="text" class="form-control" name="name" id="name" required>
          </div>

          <div class="form-group">
            <label for="section" class="col-form-label">@lang('labels.backend.access.class.table.section'):</label>
            <select type="text" name="section" class="form-control" id="section" required>
                {{-- <option value="">@lang('labels.general.select_option')</option> --}}
{{--                 @foreach($sections as $section)
                    <option value="{{$section->id}}" {{ old('section') ? 'selected' : '' }}>{{$section->name}}</option>
                @endforeach
 --}}       </select>
          </div>

          <div class="form-group">
            <label for="classtype" class="col-form-label">@lang('labels.backend.access.class.table.classroom_type'):</label>
            <select type="text" name="classtype" class="form-control" id="classtype" required>
                {{-- <option value="">@lang('labels.general.select_option')</option> --}}
{{--                 @foreach($classrooomtype as $classtype)
                    <option value="{{$classtype->id}}" {{ old('classtype') ? 'selected' : '' }}>{{$classtype->name}}</option>
                @endforeach
 --}}       </select>
          </div>

          <div class="form-group">
            <label for="instructor" class="col-form-label">@lang('labels.backend.access.class.table.instructor'):</label>
            <select type="text" name="instructor" class="form-control" id="instructor" required>
{{--                 <option value="">@lang('labels.general.select_option')</option>
                @foreach($users as $user)
                    <option value="{{$user->id}}" {{ old('user') ? 'selected' : '' }}>{{$user->name}}</option>
                @endforeach
 --}}            </select>
          </div>

          <div class="form-group">
            <label for="tags" class="col-form-label">@lang('labels.backend.access.class.table.tag'):</label>
            <select type="text" multiple="multiple" name="tags[]" class="form-control" id="tags">
            </select>
          </div>


          <div class="form-group">
            <label for="users" class="col-form-label">@lang('labels.backend.access.class.table.student'):</label>
            <select type="text" multiple="multiple" name="users[]" class="form-control" id="users" required>
                {{-- <option value="">@lang('labels.general.select_option')</option>
                @foreach($users as $user)
                    <option value="{{$user->id}}" {{ old('user') ? 'selected' : '' }}>{{$user->name}}</option>
                @endforeach --}}
            </select>
          </div>


            <div class="form-group">
                <label for="days" class="col-form-label">@lang('labels.backend.access.class.table.days'):</label>                
            </div>
            <div class="form-group">
                <label class="switch switch-label switch-pill switch-outline-primary-alt">
                  <input class="switch-input" name="days[]" value="Lunes" type="checkbox">
                  <span class="switch-slider" data-checked="&#x2713;" data-unchecked="&#x2715;"></span>
                    Lun
                </label>
                <label class="switch switch-label switch-pill switch-outline-primary-alt">
                  <input class="switch-input" name="days[]" value="Martes" type="checkbox">
                  <span class="switch-slider" data-checked="&#x2713;" data-unchecked="&#x2715;"></span>
                    Mar
                </label>
                <label class="switch switch-label switch-pill switch-outline-primary-alt">
                  <input class="switch-input" name="days[]" value="Miercoles" type="checkbox">
                  <span class="switch-slider" data-checked="&#x2713;" data-unchecked="&#x2715;"></span>
                    Mie
                </label>
                <label class="switch switch-label switch-pill switch-outline-primary-alt">
                  <input class="switch-input" name="days[]" value="Jueves" type="checkbox">
                  <span class="switch-slider" data-checked="&#x2713;" data-unchecked="&#x2715;"></span>
                    Jue
                </label>
                <label class="switch switch-label switch-pill switch-outline-primary-alt">
                  <input class="switch-input" name="days[]" value="Viernes" type="checkbox">
                  <span class="switch-slider" data-checked="&#x2713;" data-unchecked="&#x2715;"></span>
                    Vie
                </label>
                <label class="switch switch-label switch-pill switch-outline-primary-alt">
                  <input class="switch-input" name="days[]" value="Sabado" type="checkbox">
                  <span class="switch-slider" data-checked="&#x2713;" data-unchecked="&#x2715;"></span>
                    Sab
                </label>
            </div>


          <div class="form-group">
            <label for="schedule" class="col-form-label">@lang('labels.backend.access.class.table.schedule'):</label>
            <input type="time" class="form-control" name="schedule" id="schedule" required>
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
        $(document).ready(function() {
            $('.select2').select2({
                maximumSelectionSize: 6,
                width: 'resolve'
              });
        });

        $(document).ready(function() {
            $('#classtype').select2({
              ajax: {
                    url: '{{ route('admin.class.type.select') }}',
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
                placeholder: '@lang('labels.backend.access.class.table.classroom_type')',
                width: 'resolve'
              });
        });

        $(document).ready(function() {
            $('#section').select2({
              ajax: {
                    url: '{{ route('admin.class.section.select') }}',
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
                placeholder: '@lang('labels.backend.access.class.table.section')',
                width: 'resolve'
              });
        });


        $(document).ready(function() {
            $('#tags').select2({
              ajax: {
                    url: '{{ route('admin.class.tag.select') }}',
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
                placeholder: '@lang('labels.backend.access.class.table.tag')',
                multiple: true,
                width: 'resolve'
              });
        });

        $(document).ready(function() {
            $('#instructor').select2({
              ajax: {
                    url: '{{ route('admin.user.select') }}',
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
                                    text: item.first_name + ' ' + item.last_name
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
                placeholder: '@lang('labels.backend.access.class.table.instructor')',
                width: 'resolve'
              });
        });


        $(document).ready(function() {
            $('#users').select2({
              ajax: {
                    url: '{{ route('admin.user.select') }}',
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
                                    text: item.first_name + ' ' + item.last_name
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
                placeholder: '@lang('labels.backend.access.class.table.student')',
                multiple: true,
                width: 'resolve'
              });
        });

       </script>
@endpush