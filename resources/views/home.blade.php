<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="{{ str_replace('_', '-', app()->getLocale()) }}"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Página inicial</title>

    <meta name="description" content="" />

    <!-- Favicon 
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />-->

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    {{-- <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" /> --}}
    <link rel="stylesheet" href="{{asset("assets/vendor/fonts/boxicons.css")}}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{asset("assets/vendor/css/core.css")}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{asset("assets/vendor/css/theme-default.css")}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{asset("assets/css/demo.css")}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset("assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css")}}" />

    <link rel="stylesheet" href="{{asset("assets/vendor/libs/apex-charts/apex-charts.css")}}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{asset("assets/vendor/js/helpers.js")}}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{asset("assets/js/config.js")}}"></script>
    <script src="{{asset("assets/vendor/libs/jquery/jquery.js")}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="/" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img src="/images/logo.png" height="40" width="40">
              </span>
              <span class="app-brand-text demo menu-text fw-bolder ms-2">Nutri Follow</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item">
              <a href="/" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div>Início</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div>Paciente</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="/nutricionista/register-paciente" class="menu-link">
                    <div>Cadastrar Paciente</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/nutricionista/listar/pacientes" class="menu-link">
                    <div>Listar Pasciente</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/paciente/cadastro-dieta" class="menu-link">
                    <div>Atribuir Dieta</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{ route("nutricionista.criar.comorbidade.paciente") }}" class="menu-link">
                    <div>Atribuir Comorbidade</div>
                  </a>
                </li>
              </ul>
            </li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                <div>Conta</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a class="menu-link" href="#">Configurações</a>
                </li>
                <li class="menu-item">
                  <a class="menu-link" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                          {{ __('Sair') }}
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                  </form>
                </li>
              </ul>
            </li>
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class=" container-xxl navbar navbar-expand-xl align-items-center"
            id="layout-navbar"
          >
          {{-- <nav
          class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
          id="layout-navbar"
          > --}}
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center navbar-detached bg-navbar-theme" id="navbar-collapse">
              <!-- Search 
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Search..."
                    aria-label="Search..."
                  />
                </div>
              </div>-->
              <!-- /Search -->

              {{-- <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->
                <li class="nav-item lh-1 me-3">
                  <a
                    class="github-button"
                    href="https://github.com/themeselection/sneat-html-admin-template-free"
                    data-icon="octicon-star"
                    data-size="large"
                    data-show-count="true"
                    aria-label="Star themeselection/sneat-html-admin-template-free on GitHub"
                    >Star</a
                  >
                </li>

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">John Doe</span>
                            <small class="text-muted">Admin</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">Settings</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <span class="d-flex align-items-center align-middle">
                          <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                          <span class="flex-grow-1 align-middle">Billing</span>
                          <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="auth-login-basic.html">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul> --}}
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div id="pagectr" class="container">
                    @yield('content')
                </div>
              </div>
            </div>
            <!-- / Content -->

            <!-- Footer 
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , made with ❤️ by
                  <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>
                </div>
                <div>
                  <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                  <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

                  <a
                    href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                    target="_blank"
                    class="footer-link me-4"
                    >Documentation</a
                  >

                  <a
                    href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                    target="_blank"
                    class="footer-link me-4"
                    >Support</a
                  >
                </div>
              </div>
            </footer>-->
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{asset("assets/vendor/libs/popper/popper.js")}}"></script>
    <script src="{{asset("assets/vendor/js/bootstrap.js")}}"></script>
    <script src="{{asset("assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js")}}"></script>

    <script src="{{asset("assets/vendor/js/menu.js")}}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{asset("assets/vendor/libs/apex-charts/apexcharts.js")}}"></script>

    <!-- Main JS -->
    <script src="{{asset("assets/js/main.js")}}"></script>

    <!-- Page JS -->
    <script src="{{asset("assets/js/dashboards-analytics.js")}}"></script>
  </body>
</html>
