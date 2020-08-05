<div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
    <div class=" dropdown-header noti-title">
        <h6 class="text-overflow m-0">Welcome!</h6>
    </div>
    <a href="{{route('dashboard.users.show',auth()->user()->id)}}" class="dropdown-item">
        <i class="ni ni-single-02"></i>
        <span>{{ __('dashboard.my_profile') }}</span>
    </a>
    


    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        @if (LaravelLocalization::getCurrentLocale() != $localeCode)
            <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="dropdown-item">
                <i class="ni ni-support-16"></i>
                <span>{{ $properties['native'] }}</span>
            </a>  
        @endif
    @endforeach


    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">
        <i class="ni ni-user-run"></i>
        <span>{{ __('dashboard.logout') }}</span>
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>