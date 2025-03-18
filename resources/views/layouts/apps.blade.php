<!doctype html>
<html lang="en" class=" layout-menu-fixed layout-compact " data-assets-path="{{ asset('../assets/') }}"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />


    <title>Application de gestion comptable</title>



    <!-- Canonical SEO -->

    <meta name="description"
        content="Sneat Free is the best bootstrap 5 dashboard for responsive web apps. Streamline your app development process with ease." />
    <meta name="keywords"
        content="Sneat free dashboard, Sneat free bootstrap dashboard, free admin, free theme, open source, free, MIT license" />
    <meta property="og:title" content="Sneat Bootstrap Dashboard FREE by ThemeSelection" />
    <meta property="og:type" content="product" />
    <meta property="og:url" content="https://themeselection.com/item/sneat-dashboard-free-bootstrap/" />
    <meta property="og:image"
        content="https://themeselection.com/wp-content/uploads/edd/2022/07/sneat-bootstrap-html-free-smm-banner.png" />
    <meta property="og:description"
        content="Sneat Free is the best bootstrap 5 dashboard for responsive web apps. Streamline your app development process with ease." />
    <meta property="og:site_name" content="ThemeSelection" />
    <link rel="canonical" href="https://themeselection.com/item/sneat-dashboard-free-bootstrap/" />



    <!-- ? PROD Only: Google Tag Manager (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-5DDHKGP');
    </script>
    <!-- End Google Tag Manager -->

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('../assets/img/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('../assets/vendor/fonts/iconify-icons.css') }}" />

    <!-- Core CSS -->
    <!-- build:css assets/vendor/css/theme.css  -->

    <link rel="stylesheet" href="{{ asset('../assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('../assets/css/demo.css') }}" />


    <!-- Vendors CSS -->

    <link rel="stylesheet" href="{{ asset('../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- endbuild -->

    <link rel="stylesheet" href="{{ asset('../assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->


    <!-- Helpers -->
    <script src="{{ asset('../assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

    <script src="{{ asset('../assets/js/config.js') }}"></script>

</head>

<body>

    <!-- ?PROD Only: Google Tag Manager (noscript) (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5DDHKGP" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar  ">
        <div class="layout-container">

            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

                <div class="app-brand demo ">
                    <a href="/accueil" class="app-brand-link">

                        <span class="app-brand-logo demo">
                            <img src="{{ asset('../assets/img/favicon/favicon.ico') }}" alt="Logo de KOSSI BAYE"
                                style="max-width: 60px; max-height: 60px;">
                        </span>

                        <span class="app-brand-text demo menu-text fw-bold ms-0">MONIFY</span>
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                        <i class="bx bx-chevron-left d-block d-xl-none align-middle"></i>
                    </a>
                </div>


                <div class="menu-divider mt-0  "></div>

                <div class="menu-inner-shadow"></div>
                <ul class="menu-inner py-1">
                    <!-- Dashboards -->
                    <li class="menu-item ">
                        <a href="/accueil">
                            <a href="/accueil" class="menu-link ">
                                <i class="menu-icon tf-icons bx bx-home-smile"></i>
                                <div class="text-truncate" data-i18n="Dashboards">Dashboards</div>
                            </a>
                        </a>
                    </li>

                    <li class="menu-item ">
                        <a href="{{ route('budgets.create') }}" class="menu-link ">
                            <i class="menu-icon tf-icons bx bx-dock-top"></i>
                            <div class="text-truncate" data-i18n="Account Settings">Budgets</div>
                        </a>

                    </li>

                    <!-- Layouts -->
                    <li class="menu-item ">
                        <a href="{{ route('comptes.create') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-layout"></i>
                            <div class="text-truncate" data-i18n="Layouts">Comptes financiers</div>
                        </a>

                    </li>
                    <li class="menu-item ">
                        <a href="{{ route('categories.create') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-collection"></i>
                            <div class="text-truncate" data-i18n="Account Settings">Catégorie</div>
                        </a>

                    </li>
                    <!-- Front Pages -->
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-store"></i>
                            <div class="text-truncate" data-i18n="Front Pages">Mes Transactions</div>
                            <div class="badge rounded-pill bg-label-primary text-uppercase fs-tiny ms-auto"></div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{ route('transactions.index') }}" class="menu-link">
                                    <div class="text-truncate" data-i18n="Landing">Dépense</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('transactions.revenu') }}" class="menu-link">
                                    <div class="text-truncate" data-i18n="Pricing">Nouveau Revenu</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Apps & Pages -->
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Apps &amp; Pages</span>
                    </li>

                    <!-- Pages -->
                    @if (Auth::user()->statut === 'admin')
                        <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons bx bx-user"></i>
                                <div class="text-truncate" data-i18n="Authentications">Gestion Comptes</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                    <a href="{{ route('auth.register') }}" class="menu-link">
                                        <div class="text-truncate" data-i18n="Basic">Ajouter Un Compte</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="/listeCompte" class="menu-link">
                                        <div class="text-truncate" data-i18n="Basic">Liste des Comptes</div>
                                    </a>
                                </li>

                            </ul>
                        </li>
                    @endif


                </ul>
            </aside>
            <!-- / Menu -->
            <!-- Layout container -->
            <div class="layout-page">

                <!-- Navbar -->

                <nav class="layout-navbar container-xxl navbar-detached navbar navbar-expand-xl align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0   d-xl-none ">
                        <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
                            <i class="icon-base bx bx-menu icon-md"></i>
                        </a>
                    </div>


                    <div class="navbar-nav-right d-flex align-items-center justify-content-end" id="navbar-collapse">

                   


                        <ul class="navbar-nav flex-row align-items-center ms-md-auto">

                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('../assets/img/avatars/avat.png') }}" alt
                                            class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="{{ asset('../assets/img/avatars/avat.png') }}" alt
                                                            class="w-px-40 h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-0">{{ Auth::user()->name }} !</h6>
                                                    <small class="text-body-secondary">Admin</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider my-1"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#"> <i
                                                class="icon-base bx bx-user icon-md me-3"></i><span>Mon Profil</span>
                                        </a>
                                    </li>

                                    <li>
                                        <div class="dropdown-divider my-1"></div>
                                    </li>
                                    <li>
                                        <form action="{{ route('logout') }}" class="dropdown-item" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger"><i
                                                    class="icon-base bx bx-power-off icon-md me-3"></i><span>Déconnexion</span></button>
                                        </form>
                                        <a href="javascript:void(0);">
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->

                        </ul>
                    </div>

                </nav>

                <!-- / Navbar -->

                @yield('content')

            </div>
            <!-- / Layout page -->
        </div>


    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let menuItems = document.querySelectorAll(".menu-item > a"); // Liens principaux
            let subMenus = document.querySelectorAll(".menu-item.menu-toggle"); // Sous-menus

            // Récupérer les données du localStorage
            let activeMenu = localStorage.getItem("activeMenuItem");
            let openMenus = JSON.parse(localStorage.getItem("openMenus")) || [];

            // Restaurer l'élément actif
            if (activeMenu) {
                document.querySelectorAll(".menu-item").forEach(item => {
                    let link = item.querySelector("a");
                    if (link && link.getAttribute("href") === activeMenu) {
                        item.classList.add("active");
                        let parent = item.closest(".menu-item.menu-toggle");
                        if (parent) {
                            parent.classList.add("open");
                        }
                    }
                });
            }

            // Restaurer l'état des sous-menus ouverts
            openMenus.forEach(menu => {
                let menuItem = document.querySelector(`.menu-item.menu-toggle > a[href='${menu}']`);
                if (menuItem) {
                    menuItem.parentElement.classList.add("open");
                }
            });

            // Gestion du clic sur les liens du menu
            menuItems.forEach(link => {
                link.addEventListener("click", function(e) {
                    let menuItem = this.parentElement;

                    // Retirer la classe "active" de tous les items
                    document.querySelectorAll(".menu-item").forEach(el => el.classList.remove(
                        "active"));

                    // Ajouter la classe active
                    menuItem.classList.add("active");

                    // Enregistrer dans localStorage
                    localStorage.setItem("activeMenuItem", this.getAttribute("href"));
                });
            });

            // Gestion de l'ouverture/fermeture des sous-menus
            subMenus.forEach(subMenu => {
                subMenu.addEventListener("click", function() {
                    this.classList.toggle("open");

                    // Mettre à jour le localStorage
                    let updatedMenus = [];
                    document.querySelectorAll(".menu-item.menu-toggle.open > a").forEach(menu => {
                        updatedMenus.push(menu.getAttribute("href"));
                    });
                    localStorage.setItem("openMenus", JSON.stringify(updatedMenus));
                });
            });
        });
    </script>


    <script src="{{ asset('../assets/vendor/libs/jquery/jquery.js') }}"></script>

    <script src="{{ asset('../assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('../assets/vendor/js/bootstrap.js') }}"></script>

    <script src="{{ asset('../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('../assets/vendor/js/menu.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('../assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->

    <script src="{{ asset('../assets/js/main.js') }}"></script>


    <!-- Page JS -->
    <script src="{{ asset('../assets/js/dashboards-analytics.js') }}"></script>

    <!-- Place this tag before closing body tag for github widget button. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

</body>

</html>

<!-- beautify ignore:end -->
