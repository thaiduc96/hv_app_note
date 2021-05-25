<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <div>
            <p class="app-sidebar__user-name">John Doe</p>
            <p class="app-sidebar__user-designation">Frontend Developer</p>
        </div>
    </div>
    <ul class="app-menu">
        @foreach(\App\Helpers\MenuHelper::getMenu() as $menu)
            @if(!isset($menu['sub_menu']))
                <li><a class="app-menu__item active" href="{{ route($menu['route_name']) }}"><i
                            class="app-menu__icon fa fa-dashboard"></i><span
                            class="app-menu__label">{{$menu['label']}}</span></a></li>
            @else
                <li class="treeview @if(in_array(Route::currentRouteName(), $menu['child_route_name'])) is-expanded @endif">
                    <a class="app-menu__item" href="#" data-toggle="treeview"><i
                            class="app-menu__icon fa fa-laptop"></i><span
                            class="app-menu__label">{{ $menu['label'] }}</span><i
                            class="treeview-indicator fa fa-angle-right"></i></a>
                    <ul class="treeview-menu">
                        @foreach($menu['sub_menu'] as $childMenu)
                            <li><a class="treeview-item {{ Route::currentRouteName() == $childMenu['route_name'] ? 'active' : '' }}" href="{{ route($childMenu['route_name']) }}"><i
                                        class="icon fa fa-circle-o"></i> {{ $childMenu['label'] }}</a></li>
                        @endforeach
                    </ul>
                </li>
            @endif
        @endforeach
    </ul>
</aside>
