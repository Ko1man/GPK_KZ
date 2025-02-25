<div class="page-sidebar">
    <ul class="list-unstyled accordion-menu">
        @if(auth()->check() && auth()->user()->type === 'admin')
        <li class="sidebar-title">
            Админ
        </li>
        <li>
            <a href="{{route('all_users')}}"><i data-feather="home"></i>Все пользователи</a>
            <a href="{{route('getTeachers')}}"><i data-feather="home"></i>Все преподователи</a>
            <a href="{{route('getStudents')}}"><i data-feather="home"></i>Все студенты</a>
            <a href="{{route('documents')}}"><i data-feather="home"></i>Документы</a>
            <a href="{{route('attention')}}"><i data-feather="home"></i>Посещаемость</a>
        </li>
        @endif
        <li class="sidebar-title">
            Профиль
        </li>
        <li>
            <a href="email.html"><i data-feather="inbox"></i>Профиль</a>
        </li>
            @if(auth()->check() && auth()->user()->role === 'teacher')
            <li class="sidebar-title">
                документы
            </li>
                <li>
                    <a href="{{route('documents')}}"><i data-feather="home"></i>Документы</a>
                </li>
                <li class="sidebar-title">
                    Посещаемость
                </li>
                <li>
                    <a href="{{route('attention')}}"><i data-feather="home"></i>Посещаемость</a>
                </li>
                <li class="sidebar-title">
                    Списки
                </li>
                <li>
                    <a href="{{route('getStudents')}}"><i data-feather="home"></i>Все студенты</a>
                </li>
            @endif

    </ul>
</div>
