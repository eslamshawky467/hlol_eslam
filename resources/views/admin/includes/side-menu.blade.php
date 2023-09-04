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
                                data-i18n="nav.project.project_summary">عرض الاقسام</a>
                        </li>
                        <li><a class="menu-item" href="{{ route('sections.archived.sections') }}"
                                data-i18n="nav.project.project_tasks">عرض
                                الاقسام المؤرشفه</a>
                        </li>
                        <li><a class="menu-item" href="project-bugs.html" data-i18n="nav.project.project_bugs">Project
                                Bugs</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
