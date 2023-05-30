  <li class="nav-item">
    <a href="{{ route('user.home') }}" class="nav-link">
      <i class="nav-icon fas fa-chart-line"></i>
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
      <i class="nav-icon fas fa-money-check-alt"></i>
      <p>
        Policy Payments
      </p>
    </a>
  </li>
  <li class="nav-item">
    <a href="{{ route('user.claims') }}" class="nav-link">
      <i class="nav-icon fas fa-tasks"></i>
      <p>
        Manage Claims
      </p>
    </a>
  </li>
  <li class="nav-item">
      {{-- <a href="#" class="nav-link">Logout</a> --}}
    <a class="nav-link" href="{{ route('user.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="nav-icon fas fa-sign-out-alt"></i><p>Logout</p></a>
    <form action="{{ route('user.logout') }}" method="post" class="d-none" id="logout-form">@csrf</form>
  </li>