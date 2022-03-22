<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="{{ route('home.customer') }}">Finsco</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link @if(request()->is('/')) active @endif" href="{{ route('home.customer') }}">Home</a>
        </li>

        <li class="nav-item">
            <a class="nav-link @if(request()->is('/')) active @endif" href="{{ route('carts.index') }}">Cart</a>
        </li>

        <li class="nav-item">
            <a class="nav-link @if(request()->is('/')) active @endif" href="{{ route('transactions.history') }}">History</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ auth()->user()->name }} ({{ CurrencyHelper::rupiah(auth()->user()->balance) }})
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
