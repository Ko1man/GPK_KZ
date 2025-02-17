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
        </li>
        @endif
        <li class="sidebar-title">
            Профиль
        </li>
        <li>
            <a href="email.html"><i data-feather="inbox"></i>Email</a>
        </li>
        <li class="active-page">
            <a href="calendar.html"><i data-feather="calendar"></i>Calendar</a>
        </li>
        <li>
            <a href="social.html"><i data-feather="user"></i>Social</a>
        </li><li>
            <a href="file-manager.html"><i data-feather="message-circle"></i>File Manager</a>
        </li>
    </ul>
</div>
