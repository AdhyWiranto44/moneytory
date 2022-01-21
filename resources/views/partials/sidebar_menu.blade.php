<ul class="sidebar-menu-container">
    <li class="sidebar-menu-section mt-3">
        <ul>
            @foreach ($menus as $menu)
                <li class="rounded-start @if($title == $menu->name) menu-active @endif">
                    <a class="d-flex align-items-between" href="{{ $menu->url }}" title="{{ $menu->name }}">
                        <i class="{{ $menu->icon }} me-3 h4"></i>
                        <p class="mb-0">{{ $menu->name }}</p>
                    </a>
                </li>
            @endforeach
        </ul>
    </li>
</ul>