
<div class="sidebar" data-color="purple" data-image="{{url('/img/sidebar-1.jpg')}}">
    <div class="logo">
        <a href="{{ route('manager') }}" class="simple-text">
            Менъджер
        </a>
    </div>
    <div class="sidebar-wrapper" data-color="purple" >
        <ul class="nav">
            <li>
                <a href="{{route('manager')}}" >
                    {{Auth::user()->firstName}}
                </a>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="material-icons">directions_car</i>
                    <p class="active">Автопарк</p>
                </a>

                <ul class="dropdown-menu" data-color="purple" >
                    <li><a href="{{ route('show-vehicles') }}">Всички коли</a></li>
                    <li><a href="{{ route('create-vehicle') }}">Добавяне на превозно средство</a></li>
                </ul>
            </li>

            <li>
                <a href="{{route('maps')}}">
                    <i class="material-icons">place</i>
                    <p class="active">Карти</p>
                </a>
            </li>

            @if(Auth::user()->hasRole('ADMIN'))
                <li>
                    <a href="{{route('admin')}}" >
                        <i class="material-icons">reply</i>
                       Admin panel
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>