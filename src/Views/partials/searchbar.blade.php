<nav class="navbar navbar-nav">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse">
            <form method="get" class="sidebar-form col-lg-5">
                <div class="input-group">
                    <input type="text" name="q" value="{{request('q')}}" class="form-control" placeholder="search by username..">
                    <span class="input-group-btn">
                        <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                      </span>
                </div>
            </form>
            <!-- /.search form -->
            <ul class="nav navbar-nav navbar-right">
                <li>
                    @if( is_null(request('q', NULL)))
                        <a href="{{ $advancedSearchUrl }}" class="text-purple">
                            <i class="fa fa-search"></i>&nbsp;
                            <span>Advanced Search</span>
                        </a>
                    @else
                        <a href="{{ $cancelSearchUrl }}" class="btn btn-danger">
                            <i class="fa fa-times-circle"></i>&nbsp;
                            <span>cancel search</span>
                        </a>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</nav>