<div class="sidebar" data-color="purple" data-image="{{url('/img/sidebar-1.jpg')}}">
    <div class="logo">
        <a href="{{ route('customer') }}" class="simple-text">
            Kлиент
        </a>
    </div>
    <div class="sidebar-wrapper" data-color="purple" >
        <ul class="nav">
            <li>
                <a href="#" >
                    <img class="profile-img" src="http://afera.bg/wp-content/uploads/2016/05/TIKVA5678.jpg">
                    {{Auth::user()->firstName}}
                </a>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="material-icons">person</i>

                    <p class="active">Потребители</p>
                </a>
                <ul class="dropdown-menu" data-color="purple" >
                    <li><a href="#">Всички потребители</a></li>
                    <li><a href="{{ route('create-user') }}">Добавяне на потребител</a></li>
                </ul>

            </li>
        </ul>
    </div>
</div>