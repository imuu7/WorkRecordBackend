@php
    $role = \Illuminate\Support\Facades\Auth::user()->role;
@endphp
@if($role === 'admin')
    <h5>向邑數位行銷有限公司</h5>

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
@endif
<li class="{{ Request::is('configTables*') ? 'active' : '' }}">
    <a href="{{ route('configTables.index') }}">
        <span class="title">@lang('models/configTables.plural')</span>
    </a>
    <span class="icon-thumbnail"><i class="detailed fa fa-edit"></i></span>
</li>

<li class="{{ Request::is('reservations*') ? 'active' : '' }}">
    <a href="{{ route('reservations.index') }}">
        <span class="title">@lang('models/reservations.plural')</span>
    </a>
    <span class="icon-thumbnail"><i class="detailed fa fa-edit"></i></span>
</li>

<li>
    <div class="d-flex align-items-center">
        <!-- START User Info-->
        <div class="pull-left p-r-10 fs-14 font-heading d-lg-inline-block d-none m-l-20">
          <span class="semi-bold">{{ Auth::user()->name }}</span>
        </div>
        <div class="dropdown pull-right d-lg-inline-block d-none">
          <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="thumbnail-wrapper d32 circular inline">
            <img src="/assets/img/profiles/avatar.jpg" alt="" data-src="/assets/img/profiles/avatar.jpg" data-src-retina="/assets/img/profiles/avatar_small2x.jpg" width="32" height="32">
            </span>
          </button>
          <div class="dropdown-menu dropdown-menu-right profile-dropdown" role="menu">
            <a href="#" class="clearfix bg-master-lighter dropdown-item">
              <a href="{{ url('/logout') }}" class="pull-left"
                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  @lang('auth.sign_out')
              </a>
              <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                      style="display: none;">
                  @csrf
              </form>
              <span class="pull-right"><i class="pg-power"></i></span>
            </a>
          </div>
        </div>
        <!-- END User Info-->
      </div>
</li>