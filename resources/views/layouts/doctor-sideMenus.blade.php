<li class="nav-item">
    <a href="{{ route('doctor.home') }}" class="nav-link">
      <i class="nav-icon fas fa-clock"></i>
      <p>
        Dashboard
      </p>
    </a>
  </li>
  <li class="nav-item">
    <a href="{{ route('doctor.payments') }}" class="nav-link">
      <i class="nav-icon fas fa-user-plus"></i>
      <p>
        Manage Premiums
      </p>
    </a>
  </li>
  <li class="nav-item">
      {{-- <a href="#" class="nav-link">Logout</a> --}}
    <a class="nav-link" href="{{ route('user.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="nav-icon fas fa-sign-out-alt"></i><p>Logout</p></a>
    <form action="{{ route('doctor.logout') }}" method="post" class="d-none" id="logout-form">@csrf</form>
  </li>