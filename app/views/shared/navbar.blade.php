<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed solid-green" data-toggle="collapse" data-target="#navbar" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar white-lines"></span>
                <span class="icon-bar white-lines"></span>
                <span class="icon-bar white-lines"></span>
            </button>
            <a class="navbar-brand" href="/">FinSystem</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar">
            @if (! Auth::check() )
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/login" class="">Sign in</a></li>
                <li><a href="/signup" class="font-size: 300%;">Sign up</a></li>
            </ul>
            @else
            <ul class="nav navbar-nav">
                <li class="active"><a href="/dashboard">Dashboard <span class="sr-only">(current)</span></a></li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="active"><a href="/mybanks">Bank Accounts <span class="sr-only">(current)</span></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/transactions">Transactions</a></li>
                <li><a> Me <span style="color: white">[{{ Auth::user()->username }}]<span></a></li>
                <li><a href="/auth/logout" class="">Logout</a></li>
            </ul>
            @endif
        </div>
    </div>
</nav>