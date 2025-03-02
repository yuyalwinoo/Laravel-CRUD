@php
$menuItems = [
    [
        'title' => 'Profile',
        'icon' => 'lni lni-user',
        'route' => '#',
        'submenu' => []
    ],
    [
        'title' => 'Task',
        'icon' => 'lni lni-agenda',
        'route' => '#',
        'submenu' => []
    ],
    [
        'title' => 'Post',
        'icon' => 'lni lni-protection',
        'route' => '#',
        'submenu' => [
            [
                'title' => 'Post Register',
                'route' => route('posts.create')
            ],
            [
                'title' => 'View Posts',
                'route' => route('posts.index')
            ]
        ]
    ],
    // [
    //     'title' => 'User',
    //     'icon' => 'lni lni-protection',
    //     'route' => '#',
    //     'submenu' => [
    //         [
    //             'title' => 'User Register',
    //             'route' => route('users.create')
    //         ],
    //         [
    //             'title' => 'User List',
    //             'route' => route('users.index')
    //         ],
    //     ]
    // ]
];
@endphp


<!-- Sidebar -->
<aside id="sidebar" class="sidebar-toggle">
    
    <!-- Sidebar Navigation -->
    <ul class="sidebar-nav p-0">
        <li class="sidebar-header">Tools & Components</li>

        @foreach($menuItems as $item)
            <li class="sidebar-item">
                @if(empty($item['submenu']))
                    <a href="{{ $item['route'] }}" class="sidebar-link">
                        <i class="{{ $item['icon'] }}"></i>
                        <span>{{ $item['title'] }}</span>
                    </a>
                @else
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#{{ Str::slug($item['title'], '-') }}" aria-expanded="false">
                        <i class="{{ $item['icon'] }}"></i>
                        <span>{{ $item['title'] }}</span>
                    </a>
                    <ul id="{{ Str::slug($item['title'], '-') }}" class="sidebar-dropdown show list-unstyled collapse ms-4">
                        @foreach($item['submenu'] as $subItem)
                            <li class="sidebar-item">
                                <a href="{{ $subItem['route'] }}" class="sidebar-link">{{ $subItem['title'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
    <!-- Sidebar Navigation Ends -->
    <div class="sidebar-footer">
        <a href="#" class="sidebar-link">
            <i class="lni lni-exit"></i>
            <span>Setting</span>
        </a>
    </div>
</aside>
<!-- Sidebar Ends -->
