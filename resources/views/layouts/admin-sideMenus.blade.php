<li class="nav-item">
      {{-- <a href="#" class="nav-link">Logout</a> --}}
    <a class="nav-link" href="{{ route('user.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="nav-icon fas fa-sign-out-alt"></i>Logout</a>
    <form action="{{ route('user.logout') }}" method="post" class="d-none" id="logout-form">@csrf</form>
  </li>