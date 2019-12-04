<aside class="menu">
    @can('edit_page_content_in_admin')
        <p class="menu-label">
            <span class="icon">
                <span class="fas fa-file"></span>
            </span>Pages
        </p>
        <ul class="menu-list">
            @foreach ($pages as $page)
                <li><a{!! (Request::is('admin/pages/' . $page->name) ? ' class="is-active"' : '') !!} href="/admin/pages/{{ $page->name }}">{{ $page->displayName }}</a></li>
            @endforeach
        </ul>
    @endcan

    @can('edit_global_content_in_admin')
        <p class="menu-label" v-tooltip="'Content and settings that are provided to all pages'">
            <span class="icon">
                <span class="fas fa-globe-africa"></span>
            </span>Global Content
        </p>
        <ul class="menu-list">
            <li><a{!! (Request::is('admin/global') ? ' class="is-active"' : '') !!} href="/admin/global">Edit Global Content</a></li>
        </ul>
    @endcan

    @can('manage_users_in_admin')
        <p class="menu-label">
            <span class="icon">
                <span class="fas fa-tools"></span>
            </span>Users
        </p>
        <ul class="menu-list">
            <li><a{!! (Request::is('admin/users') ? ' class="is-active"' : '') !!} href="/admin/users">Manage Users</a></li>
        </ul>
    @endcan

    @can('use_tools_in_admin')
        <p class="menu-label">
            <span class="icon">
                <span class="fas fa-tools"></span>
            </span>Tools
        </p>
        <ul class="menu-list">
            <li><a{!! (Request::is('admin/pages') ? ' class="is-active"' : '') !!} href="/admin/pages">Manage Pages</a></li>
            <li><a{!! (Request::is('admin/global/fields/manage') ? ' class="is-active"' : '') !!} href="/admin/global/fields/manage">Manage Global Fields</a></li>
        </ul>
    @endcan
</aside>