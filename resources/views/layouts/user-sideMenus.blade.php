  <li class="nav-item">
    <a href="{{ route('user.home') }}" class="nav-link">
      <i class="nav-icon fas fa-clock"></i>
      <p>
        Dashboard
      </p>
    </a>
  </li>

  <li class="nav-item">
    <a href="{{ route('user.policies') }}" class="nav-link">
      <i class="nav-icon fas fa-file"></i>
      <p>
        Manage Policies
      </p>
    </a>
  </li>

  <li class="nav-item">
    <a href="{{ route('user.clients') }}" class="nav-link">
      <i class="nav-icon fas fa-user-plus"></i>
      <p>
        Manage Clients
      </p>
    </a>
  </li>
  <li class="nav-item">
    <a href="{{ route('user.payments') }}" class="nav-link">
      <i class="nav-icon fas fa-user-plus"></i>
      <p>
        Manage Premiums
      </p>
    </a>
  </li>
  <li class="nav-item">
      {{-- <a href="#" class="nav-link">Logout</a> --}}
    <a class="nav-link" href="{{ route('user.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="nav-icon fas fa-sign-out-alt"></i><p>Logout</p></a>
    <form action="{{ route('user.logout') }}" method="post" class="d-none" id="logout-form">@csrf</form>
  </li>