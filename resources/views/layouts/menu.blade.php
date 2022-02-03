<li class="{{ Request::is('clockins*') ? 'active' : '' }}">
    <a href="{{ route('clockins.index') }}">
        <span class="title">@lang('models/clockins.plural')</span>
    </a>
    <span class="icon-thumbnail"><i class="detailed fa fa-edit"></i></span>
</li>

@if(auth()->user()->role === 'admin')
    <li class="{{ Request::is('users*') ? 'active' : '' }}">
        <a href="{{ route('users.index') }}">
            <span class="title">@lang('models/users.plural')</span>
        </a>
        <span class="icon-thumbnail"><i class="detailed fa fa-user"></i></span>
    </li>

    <li class="{{ Request::is('lineConfigs*') ? 'active' : '' }}">
        <a href="{{ route('lineConfigs.index') }}">
            <span class="title">@lang('models/lineConfigs.plural')</span>
        </a>
        <span class="icon-thumbnail"><i class="detailed fa fa-cog"></i></span>
    </li>

    <li class="{{ Request::is('configTables*') ? 'active' : '' }}">
        <a href="{{ route('configTables.index') }}">
            <span class="title">@lang('models/configTables.plural')</span>
        </a>
        <span class="icon-thumbnail"><i class="detailed fa fa-edit"></i></span>
    </li>

    <li class="{{ Request::is('telMsgLogs*') ? 'active' : '' }}">
        <a href="{{ route('telMsgLogs.index') }}">
            <span class="title">@lang('models/telMsgLogs.plural')</span>
        </a>
        <span class="icon-thumbnail"><i class="detailed fa fa-cog"></i></span>
    </li>

    <li class="{{ Request::is('vue-migration*') ? 'active' : '' }}">
        <a href="/vue-migration">
            <span class="title">資料表遷移</span>
        </a>
        <span class="icon-thumbnail"><i class="detailed fa fa-code"></i></span>
    </li>

    <li class="{{ Request::is('reservations*') ? 'active' : '' }}">
        <a href="{{ route('reservations.index') }}">
            <span class="title">@lang('models/reservations.plural')</span>
        </a>
        <span class="icon-thumbnail"><i class="detailed fa fa-edit"></i></span>
    </li>
@endif
