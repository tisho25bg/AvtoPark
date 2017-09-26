<div class="sidebar" data-color="purple" data-image="{{url('/img/sidebar-1.jpg')}}">
    <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text">
            Шофьор
        </a>
    </div>
    <div class="sidebar-wrapper" data-color="purple" >
        <ul class="nav">
            <li>
                <a href="#" >
                    <img class="profile-img" src="https://scontent-sof1-1.xx.fbcdn.net/v/t1.0-9/10922855_1551211045151770_1862976727381693079_n.jpg?oh=46a483c1cc33abf5c7ab86e6e5f71be5&oe=5A42C558">
                    Лена
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