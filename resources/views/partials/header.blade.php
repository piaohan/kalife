
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <a class="logo" href="{{url('/')}}">
                        <img src="{{asset('img/logo-invert.png')}}" alt="Image Alternative text" title="Image Title" />
                    </a>
                </div>
                <div class="col-md-4">
                    <div class="top-user-area clearfix">
                        <ul class="top-user-area-list list list-horizontal list-border">
                            @if(auth()->guest())
                            <li class="top-user-area-avatar">
                                <a>Guest</a>
                            </li>
                            <li><a href="{{url('/register-login')}}">Sign in</a>
                            </li>
                                @endif
                            @if(!auth()->guest())
                                    <li class="top-user-area-avatar">
                                        <a href="{{url('/manage-user')}}">
                                            @if(is_null(auth()->user()->profile_photo))
                                                @if(auth()->user()->gender == 1)
                                                    <img class="origin round" src="{{asset('/img/male.png')}}" alt="Image Alternative text" title="{{auth()->user()->first_name}}" />
                                                @elseif(auth()->user()->gender == 2)
                                                    <img class="origin round" src="{{asset('/img/female.png')}}" alt="Image Alternative text" title="{{auth()->user()->first_name}}" />
                                                @endif
                                            @else
                                                <img class="origin round" src="{{asset(auth()->user()->profile_photo)}}" alt="Image Alternative text" title="{{auth()->user()->first_name}}" />
                                            @endif
                                            Hi, {{auth()->user()->first_name}} </a>
                                    </li>
                                    <li>
                                        <a href="{{url('/bookings')}}" class="btn btn-default" style="color:#000;">Bookings</a>
                                    </li>
                                    <li><a href="{{url('/logout')}}">Sign Out</a>
                                    </li>
                                @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

