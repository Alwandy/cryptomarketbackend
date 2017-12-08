    <div class="cover">
    <div class="clearfix"></div>
    <nav class="navbar navbar-expand-lg">
            <span class="navbar-brand mb-0 h1">NeuMarketCap</span>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse nav justify-content-end" id="navbarNav">
              <ul class="nav justify-content-end">
                <li class="nav-item active">
                  <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Exchange</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link disabled" href="#">Sponsors</a>
                </li>
                @guest
                <li class="nav-item">
                  <a class="nav-link disabled" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link disabled" href="{{ route('register') }}">Register</a>
                </li>
                @else
                <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
              </ul>
            </div>
          </nav>
          <div class="container" align="center" style="margin-top:150px">
                <h1 class="text-center">Check today market currency worth!</h1>
                <h3 class="text-center">NeuMarketCap provides you the need to browse worlds cryptocurrency and get list of verified exchanges</h3>
               <br>
                <div class="col-sm-3">          
                <div class="input-group stylish-input-group">
                                <input type="text" class="form-control"  placeholder="Search" >
                                <span class="input-group-addon">
                                    <button type="submit">
                                        <span class="fa fa-search"></span>
                                    </button>  
                                </span>
                            </div>
                </div>
            </div>
        </div>
