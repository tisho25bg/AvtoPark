<div class="sidebar" data-color="purple" data-image="{{url('/img/sidebar-1.jpg')}}">
    <div class="logo">
        <a href="{{ route('customer') }}" class="simple-text">
            Kлиент
        </a>
    </div>
    <div class="sidebar-wrapper" data-color="purple" >
        <ul class="nav">
            <li>
                <a href="{{route('customer')}}" >
                    {{Auth::user()->firstName}}
                </a>
            </li>
            <li class="dropdown">
            @if(Auth::user()->hasRole('ADMIN'))
                <li>
                    <a href="{{route('admin')}}" >
                        <i class="material-icons">reply</i>
                        Admin panel
                    </a>
                </li>
                @endif
            </li>
        </ul>
    </div>
</div>