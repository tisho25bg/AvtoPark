
<div class="sidebar" data-color="purple" data-image="{{url('/img/sidebar-1.jpg')}}">
    <div class="logo">
        <a href="{{ route('manager') }}" class="simple-text">
            Менъджер
        </a>
    </div>
    <div class="sidebar-wrapper" data-color="purple" >
        <ul class="nav">
            <li>
                <a href="#" >
                    <img class="profile-img" src="https://scontent-sof1-1.xx.fbcdn.net/v/t1.0-9/21618013_1846654168696341_6177217922365790204_n.jpg?oh=5f82119bf4ba21b251d5d311fe0c3df9&oe=5A46FD0E">
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