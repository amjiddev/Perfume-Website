
<div class="menu menu-column menu-rounded menu-sub-indention px-3 fw-semibold fs-6" id="#kt_app_sidebar_menu"
    data-kt-menu="true" data-kt-menu-expand="false">
    <!--begin:Menu item-->
    <div data-kt-menu-trigger="click"
        class="menu-item menu-accordion {{ request()->routeIs('dashboard') ? 'here show' : '' }}">
        <!--begin:Menu link-->
        <span class="menu-link">
            <span class="menu-icon">{!! getIcon('element-11', 'fs-2') !!}</span>
            <span class="menu-title">Dashboards</span>
            <span class="menu-arrow"></span>
        </span>
        <!--end:Menu link-->

        <div class="menu-sub menu-sub-accordion">
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('admin-landing-page.*') ? 'active' : '' }}"
                    href="{{ route('admin-landing-page.list') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">{{ __('Landing Page') }}</span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('admin.shop-page.*') ? 'active' : '' }}"
                    href="{{ route('admin.shop-page.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">{{ __('Shop Page') }}</span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('admin.perfume-page.*') ? 'active' : '' }}"
                    href="{{ route('admin.perfume-page.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">{{ __('Perfume Page') }}</span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('admin.attar-page.*') ? 'active' : '' }}"
                    href="{{ route('admin.attar-page.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">{{ __('Attar Page') }}</span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('admin.about-page.*') ? 'active' : '' }}"
                    href="{{ route('admin.about-page.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">{{ __('About Page') }}</span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('admin.contact-page.*') ? 'active' : '' }}"
                    href="{{ route('admin.contact-page.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">{{ __('Contact Page') }}</span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('admin.guest-gift.*') ? 'active' : '' }}"
                    href="{{ route('admin.guest-gift.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">{{ __('Guest Gifts') }}</span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}"
                    href="{{ route('admin.messages.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">{{ __('Messages') }}</span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('admin.email-subscriptions.*') ? 'active' : '' }}"
                    href="{{ route('admin.email-subscriptions.index') }}">
                    <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                    </span>
                    <span class="menu-title">{{ __('Email Subscriptions') }}</span>
                </a>
            </div>
        </div>
    </div>
</div>
