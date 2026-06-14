<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme"
    style="transition: opacity 0.5s ease, height 0.5s ease, padding 0.5s ease;">
    <div class="app-brand demo mb-2">
        <a href="<?= url('/') ?>" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="<?= asset('/assets/images/sigasi-logo.png') ?>" style="width:20%;" alt="">
            </span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item <?= $menu_code == 'home' ? 'active' : '' ?>">
            <a href="<?= url('/') ?>" class="menu-link">
                <div data-i18n="Analytics">Beranda</div>
            </a>
        </li>
        @foreach ($menus as $menu)
            @if (str_contains(strtolower($menu['Menu']), 'index'))
                <li class="menu-item <?= $menu_code == $menu['MenuCode'] ? 'active' : '' ?>">
                    <a href="<?= url($menu['Url']) ?>" class="menu-link">
                        <div data-i18n="Analytics">{{ str_replace('Index', '', $menu['Menu']) }}</div>
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</aside>
