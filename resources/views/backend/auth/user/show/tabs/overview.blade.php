<div class="col">
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.avatar')</th>
                <td><img src="{{ $user->picture }}" class="user-profile-image" /></td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.name')</th>
                <td>{{ $user->name }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.email')</th>
                <td>{{ $user->email }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.status')</th>
                <td>{!! $user->status_label !!}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.confirmed')</th>
                <td>{!! $user->confirmed_label !!}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.phone')</th>
                <td>
                    {{ optional($user->customer)->phone  }}
                </td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.age')</th>
                <td>
                @if(isset($user->customer->age))
                    {!! Carbon::parse($user->customer->age)->age !!} @lang('labels.backend.access.users.tabs.content.overview.years_old')
                    — {{ $user->customer->age  }}
                @endif
                </td>
            </tr>
            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.address')</th>
                <td>
                    {{ optional($user->customer)->address }}
                </td>
            </tr>
            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.blood')</th>
                <td>
                @if(isset($user->customer->blood_id))
                    {{ optional($user->customer->blood)->name }}
                @endif
                </td>
            </tr>

            @if(isset($user->customer->school_id))
            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.school')</th>
                <td>
                    {{ $user->customer->school->name }}
                </td>
            </tr>
            @endif

            @if(isset($user->customer->grade))
            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.grade')</th>
                <td>
                    {{ $user->customer->grade }}
                </td>
            </tr>
            @endif

            @if(isset($user->customer->ins))
            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.ins')</th>
                <td>
                    {{ $user->customer->ins }}
                </td>
            </tr>
            @endif

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.timezone')</th>
                <td>{{ $user->timezone }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.last_login_at')</th>
                <td>
                    @if($user->last_login_at)
                        {{ timezone()->convertToLocal($user->last_login_at) }}
                    @else
                        N/A
                    @endif
                </td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.last_login_ip')</th>
                <td>{{ $user->last_login_ip ?? 'N/A' }}</td>
            </tr>
        </table>
    </div>
</div><!--table-responsive-->
