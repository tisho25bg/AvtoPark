<div class="sidebar" data-color="purple" data-image="{{url('/img/sidebar-1.jpg')}}">
    <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text">
            Администратор
        </a>
    </div>
    <div class="sidebar-wrapper" data-color="purple" >
        <ul class="nav">
            <li>
                <a href="#" >
                    <img class="profile-img" src="https://camo.githubusercontent.com/b13329b2b190e6c3cdeea540221d1b7506b0c903/68747470733a2f2f7261772e6769746875622e636f6d2f6d696b6f6c616c7973656e6b6f2f6c656e612f6d61737465722f6c656e612e706e67">
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


            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="material-icons">directions_car</i>
                    <p class="active">Автопарк</p>
                </a>

                <ul class="dropdown-menu" data-color="purple" >
                    <li><a href="{{ route('home') }}">Всички коли</a></li>
                    <li><a href="{{ route('create-vehicle') }}">Добавяне на превозно средство</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>