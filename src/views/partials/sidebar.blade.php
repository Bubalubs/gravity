<aside class="menu">
    <p class="menu-label">
        Pages
    </p>
    <ul class="menu-list">
        @foreach ($pages as $page)
            <li><a href="/admin/pages/{{ $page->name }}">{{ $page->displayName }}</a></li>
        @endforeach
    </ul>
    <p class="menu-label">
        Tools
    </p>
    <ul class="menu-list">
        <li><a href="/admin/pages">Manage Pages</a></li>
    </ul>
</aside>