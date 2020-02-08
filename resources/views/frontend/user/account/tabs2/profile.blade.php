<div class="table-responsive">
    <table class="table table-striped table-hover table-bordered">
        <tr>
            <th>@lang('labels.frontend.user.profile.avatar')</th>
            <td><img src="{{ $logged_in_user->picture }}" class="user-profile-image" /></td>
        </tr>
        <tr>
            <th>@lang('labels.frontend.user.profile.name')</th>
            <td>{{ $logged_in_user->name }}</td>
        </tr>
        <tr>
            <th>@lang('labels.frontend.user.profile.email')</th>
            <td>{{ $logged_in_user->email }}</td>
        </tr>
        @if(!empty($logged_in_user->customer->blood_id))
        <tr>
            <th>@lang('labels.frontend.user.profile.blood')</th>
            <td>{{ optional($logged_in_user->customer->blood)->name }}</td>
        </tr>
        @endif

        @if(!empty($logged_in_user->customer->phone))
        <tr>
            <th>@lang('labels.frontend.user.profile.phone')</th>
            <td>{{ optional($logged_in_user->customer)->phone  }}</td>
        </tr>
        @endif

        @if(isset($logged_in_user->customer->age))
        <tr>
            <th>@lang('labels.frontend.user.profile.age')</th>
            <td>
            {!! Carbon::parse($logged_in_user->customer->age)->age !!} @lang('labels.backend.access.users.tabs.content.overview.years_old')
            — <i>{{ $logged_in_user->customer->age  }}</i>
            </td>
        </tr>
        @endif

        @if(!empty($logged_in_user->customer->school_id))
        <tr>
            <th>@lang('labels.frontend.user.profile.school')</th>
            <td>{{ optional($logged_in_user->customer->school)->name }}</td>
        </tr>
        @endif

        @if(!empty($logged_in_user->customer->grade))
        <tr>
            <th>@lang('labels.frontend.user.profile.grade')</th>
            <td>{{ optional($logged_in_user->customer)->grade  }}</td>
        </tr>
        @endif

        @if(!empty($logged_in_user->customer->address))
        <tr>
            <th>@lang('labels.frontend.user.profile.address')</th>
            <td>{{ optional($logged_in_user->customer)->address  }}</td>
        </tr>
        @endif

        <tr>
            <th>@lang('labels.frontend.user.profile.created_at')</th>
            <td>{{ timezone()->convertToLocal($logged_in_user->created_at, 'd-m-Y, g:i:s a') }} ({{ $logged_in_user->created_at->diffForHumans() }})</td>
        </tr>
        <tr>
            <th>@lang('labels.frontend.user.profile.last_updated')</th>
            <td>{{ timezone()->convertToLocal($logged_in_user->updated_at, 'd-m-Y, g:i:s a') }} ({{ $logged_in_user->updated_at->diffForHumans() }})</td>
        </tr>
    </table>
</div>
