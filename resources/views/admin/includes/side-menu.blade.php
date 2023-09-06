    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">


                <li class=" nav-item"><a href="{{ route('home') }}"><i class="la la-home"></i><span class="menu-title"
                            data-i18n="nav.scrumboard.main">الرئيسيه</span></a>
                </li>
                <li class=" nav-item"><a href="#"><i class="la la-briefcase"></i><span class="menu-title"
                            data-i18n="nav.project.main">الاقسام</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="{{ route('sections.index') }}"
                                data-i18n="nav.project.project_summary">عرض الاقسام <span
                                    class="badge badge-info float-lg-right">{{ App\Models\Section::count() }}</span></a>
                        </li>
                        <li><a class="menu-item" href="{{ route('sections.archived.sections') }}"
                                data-i18n="nav.project.project_tasks">عرض
                                الاقسام المؤرشفه<span
                                    class="badge badge-info float-lg-right">{{ App\Models\Section::onlyTrashed()->count() }}</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="la la-briefcase"></i><span class="menu-title"
                            data-i18n="nav.project.main">العملاء</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="{{ route('clients.index') }}"
                                data-i18n="nav.project.project_summary">عرض العملاء <span
                                    class="badge badge-info float-lg-right">{{ App\Models\Section::count() }}</span></a>
                        </li>
                        <li><a class="menu-item" href="{{ route('clients.status.filter', 'active') }}"
                                data-i18n="nav.project.project_tasks">عرض العملاء المفعلين<span
                                    class="badge badge-info float-lg-right"></span></a>
                        </li>
                        <li><a class="menu-item" href="{{ route('clients.status.filter', 'inactive') }}"
                                data-i18n="nav.project.project_tasks">عرض العملاء الغير مفعلين<span
                                    class="badge badge-info float-lg-right"></span></a>
                        </li>
                        <li><a class="menu-item" href="{{ route('clients.is.register.filter', '1') }}"
                                data-i18n="nav.project.project_tasks">عرض العملاء المسجلين<span
                                    class="badge badge-info float-lg-right"></span></a>
                        </li>
                        <li><a class="menu-item" href="{{ route('clients.is.register.filter', '0') }}"
                                data-i18n="nav.project.project_tasks">عرض العملاء الغير مسجلين<span
                                    class="badge badge-info float-lg-right"></span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="la la-briefcase"></i><span class="menu-title"
                            data-i18n="nav.project.main">الاعدادت</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="/settings/about-us" data-i18n="nav.project.project_summary">
                                معلومات عنا </a>
                        </li>
                        <li><a class="menu-item" href="/settings/technical-support"
                                data-i18n="nav.project.project_tasks">
                                الدعم الفنى
                        </li>
                        <li><a class="menu-item" href="{{ route('settings.fqa.index') }}"
                                data-i18n="nav.project.project_summary"> الاسئله والاجابه <span
                                    class="badge badge-info float-lg-right">{{ App\Models\Setting::where('type', '=', 'fqa')->count() }}</span></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
