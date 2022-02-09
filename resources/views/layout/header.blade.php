<div class="topnav">
 
  <a class="{{ '/'==request()->path() ? 'active' : ''}}" href="{{ route('user.index') }}">User</a>

  <a class="" href="{{ route('logout') }}"
                                      onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                     </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
    </form>


</div> 
