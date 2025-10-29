<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', __('admin.dashboard'))</title>

    <!-- Bootstrap 5 RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        .sidebar { min-height: 100vh; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .sidebar .nav-link { color: rgba(255,255,255,0.8); padding: 15px 20px; border-radius: 10px; margin: 5px 10px; transition: all 0.3s; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background: rgba(255,255,255,0.1); color: white; transform: translateX(-5px); }
        .main-content { background-color: #f8f9fa; min-height: 100vh; }
        .card { border: none; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); }
        .stats-card { background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%); color: white; }
        .stats-card.success { background: linear-gradient(135deg, #00d2d3 0%, #54a0ff 100%); }
        .stats-card.warning { background: linear-gradient(135deg, #feca57 0%, #ff9ff3 100%); }
        .stats-card.info { background: linear-gradient(135deg, #48dbfb 0%, #0abde3 100%); }
    </style>
    @stack('styles')
    @yield('styles')

    <!-- Keep fonts consistent -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <h4 class="text-white">{{ __('admin.dashboard') }}</h4>
                        <small class="text-white-50">{{ __('admin.welcome', ['name' => Auth::guard('admin')->user()->name]) }}</small>
                    </div>

                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                               href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-tachometer-alt me-2"></i>
                                {{ __('admin.home') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
                               href="{{ route('admin.users.index') }}">
                                <i class="fas fa-users me-2"></i>
                                {{ __('admin.users') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.content.*') ? 'active' : '' }}"
                               href="{{ route('admin.content.index') }}">
                                <i class="fas fa-edit me-2"></i>
                                {{ __('admin.manage_content') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.team.*') ? 'active' : '' }}"
                               href="{{ route('admin.team.index') }}">
                                <i class="fas fa-users-gear me-2"></i>
                                {{ __('admin.team') }}
                            </a>
                        </li>

                        <!-- Newly added: Press and Careers management links -->
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.press.*') ? 'active' : '' }}"
                               href="{{ route('admin.press.index') }}">
                                <i class="fas fa-newspaper me-2"></i>
                                {{ __('admin.manage_press_blog') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.careers.*') ? 'active' : '' }}"
                               href="{{ route('admin.careers.index') }}">
                                <i class="fas fa-briefcase me-2"></i>
                                {{ __('admin.manage_careers') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}"
                               href="{{ route('admin.settings') }}">
                                <i class="fas fa-cog me-2"></i>
                                {{ __('admin.settings') }}
                            </a>
                        </li>                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.content.language.*') ? 'active' : '' }}"
                               href="{{ route('admin.content.language.manage', app()->getLocale()) }}"> 
                                <i class="fas fa-language me-2"></i>
                                {{ __('admin.edit_languages') }}
                            </a>
                        </li>
                        <li class="nav-item mt-4">
                            <form action="{{ route('admin.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link text-start w-100">
                                    <i class="fas fa-sign-out-alt me-2"></i>
                                    {{ __('admin.logout') }}
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">@yield('page-title', __('admin.dashboard'))</h1>
                </div>

                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
                @stack('scripts')

            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        if (window.tinymce) {
          tinymce.init({
            selector: 'textarea[name="body"], textarea[name="excerpt"]',
            plugins: 'lists link image code table autoresize',
            toolbar: 'undo redo | styles | bold italic underline | bullist numlist | link image table | alignleft aligncenter alignright | code',
            menubar: false,
            height: 350,
          });
        }
      });
    </script>
    @yield('scripts')
</body>
</html>


