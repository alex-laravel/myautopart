<div class="account-nav flex-grow-1">
    <h4 class="account-nav__title">Navigation</h4>

    <ul class="account-nav__list">
        <li class="account-nav__item {{ (request()->routeIs('frontend.account.dashboard')) ? 'account-nav__item--active' : '' }}">
            <a href="{{ route('frontend.account.dashboard') }}">Dashboard</a>
        </li>

        <li class="account-nav__item {{ (request()->routeIs('frontend.account.garage')) ? 'account-nav__item--active' : '' }}">
            <a href="{{ route('frontend.account.garage') }}">Garage</a>
        </li>

        <li class="account-nav__item {{ (request()->routeIs('frontend.account.orders')) ? 'account-nav__item--active' : '' }}">
            <a href="{{ route('frontend.account.orders') }}">Orders</a>
        </li>

        <li class="account-nav__item {{ (request()->routeIs('frontend.account.profile')) ? 'account-nav__item--active' : '' }}">
            <a href="{{ route('frontend.account.profile') }}">Profile</a>
        </li>

        <li class="account-nav__item {{ (request()->routeIs('frontend.account.password')) ? 'account-nav__item--active' : '' }}">
            <a href="{{ route('frontend.account.password') }}">Password</a>
        </li>

        <li class="account-nav__divider" role="presentation"></li>

        <li class="account-nav__item ">
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ trans('buttons.auth.logout') }}
            </a>
        </li>
    </ul>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>
