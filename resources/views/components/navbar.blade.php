<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="{{ route('home') }}">Finsco</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link @if(request()->is('/')) active @endif" href="{{ route('home') }}">Dashborad</a>
        </li>
        @if (auth()->user()->role->slug == 'admin')
        <li class="nav-item">
            <a class="nav-link @if(request()->segment(1) == 'users') active @endif" href="{{ route('users.index') }}">Users</a>
        </li>
        @endif

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle @if(request()->segment(1) == 'transactions') active @endif" role="button" data-bs-toggle="dropdown" aria-expanded="false">Transactions</a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionDropdown">
            @if (auth()->user()->role->slug == 'admin' || auth()->user()->role->slug == 'bank')
            <li><a href="{{ route('transactions.index', "type=top-up") }}" class="dropdown-item">Top Up</a></li>
            <li><a href="{{ route('transactions.index', "type=withdraw") }}" class="dropdown-item">Withdraw</a></li>
            @else
            <li><a href="{{ route('transactions.index', "type=purchase") }}" class="dropdown-item">Purchase</a></li>
            @endif
          </ul>
        </li>

        @if (auth()->user()->role->slug == 'toko')
        <li class="nav-item">
          <a class="nav-link @if(request()->segment(1) == 'products') active @endif" href="{{ route('products.index') }}">Products</a>
        </li>
        @endif
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ auth()->user()->name }}
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-link dropdown-item text-danger">Logout</button>
                </form>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
