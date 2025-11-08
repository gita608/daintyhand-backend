<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - DaintyHand</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: #f0f2f5;
            color: #333;
        }
        
        /* Sidebar */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 260px;
            background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
            color: white;
            overflow-y: auto;
            z-index: 1000;
            transition: transform 0.3s ease;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        
        .sidebar-header {
            padding: 25px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            background: rgba(0,0,0,0.2);
        }
        
        .sidebar-header h1 {
            font-size: 20px;
            font-weight: 600;
            color: white;
        }
        
        .sidebar-header .subtitle {
            font-size: 12px;
            color: rgba(255,255,255,0.6);
            margin-top: 5px;
        }
        
        .sidebar-menu {
            padding: 20px 0;
        }
        
        .menu-section {
            margin-bottom: 30px;
        }
        
        .menu-section-title {
            padding: 0 20px 10px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255,255,255,0.5);
            font-weight: 600;
        }
        
        .menu-item {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }
        
        .menu-item:hover {
            background: rgba(255,255,255,0.1);
            color: white;
            border-left-color: #667eea;
        }
        
        .menu-item.active {
            background: rgba(102, 126, 234, 0.2);
            color: white;
            border-left-color: #667eea;
        }
        
        .menu-item-icon {
            font-size: 18px;
            margin-right: 12px;
            width: 24px;
            text-align: center;
        }
        
        .menu-item-text {
            font-size: 14px;
            font-weight: 500;
        }
        
        /* Main Content */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }
        
        /* Top Header */
        .top-header {
            background: white;
            padding: 15px 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .top-header h2 {
            font-size: 20px;
            font-weight: 600;
            color: #111827;
        }
        
        .header-actions {
            display: flex;
            gap: 15px;
            align-items: center;
        }
        
        .header-actions span {
            font-size: 14px;
            color: #6b7280;
        }
        
        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            transition: all 0.3s;
            font-weight: 500;
        }
        
        .btn-logout {
            background: #ef4444;
            color: white;
        }
        
        .btn-logout:hover {
            background: #dc2626;
        }
        
        .btn-primary {
            background: #667eea;
            color: white;
        }
        
        .btn-primary:hover {
            background: #5568d3;
        }
        
        /* Content Area */
        .content-area {
            padding: 30px;
        }
        
        /* Mobile Menu Toggle */
        .menu-toggle {
            display: none;
            background: #667eea;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 20px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.open {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .menu-toggle {
                display: block;
            }
            
            .content-area {
                padding: 20px;
            }
        }
        
        /* Overlay for mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }
        
        @media (max-width: 768px) {
            .sidebar-overlay.active {
                display: block;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h1>🎨 DaintyHand</h1>
            <div class="subtitle">Admin Panel</div>
        </div>
        
        <div class="sidebar-menu">
            <div class="menu-section">
                <div class="menu-section-title">Main</div>
                <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="menu-item-icon">📊</span>
                    <span class="menu-item-text">Dashboard</span>
                </a>
            </div>
            
            <div class="menu-section">
                <div class="menu-section-title">Products</div>
                <a href="{{ route('admin.products.index') }}" class="menu-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <span class="menu-item-icon">🛍️</span>
                    <span class="menu-item-text">Manage Products</span>
                </a>
                <a href="{{ route('admin.categories.index') }}" class="menu-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <span class="menu-item-icon">📁</span>
                    <span class="menu-item-text">Categories</span>
                </a>
            </div>
            
            <div class="menu-section">
                <div class="menu-section-title">Orders</div>
                <a href="{{ route('admin.orders.index') }}" class="menu-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <span class="menu-item-icon">📦</span>
                    <span class="menu-item-text">View Orders</span>
                </a>
                <a href="{{ route('admin.custom-orders.index') }}" class="menu-item {{ request()->routeIs('admin.custom-orders.*') ? 'active' : '' }}">
                    <span class="menu-item-icon">🎨</span>
                    <span class="menu-item-text">Custom Orders</span>
                </a>
            </div>
            
            <div class="menu-section">
                <div class="menu-section-title">Communication</div>
                <a href="{{ route('admin.contact-messages.index') }}" class="menu-item {{ request()->routeIs('admin.contact-messages.*') ? 'active' : '' }}">
                    <span class="menu-item-icon">💬</span>
                    <span class="menu-item-text">Contact Messages</span>
                </a>
            </div>
            
            <div class="menu-section">
                <div class="menu-section-title">Users</div>
                <a href="{{ route('admin.users.index') }}" class="menu-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <span class="menu-item-icon">👥</span>
                    <span class="menu-item-text">Manage Users</span>
                </a>
            </div>
        </div>
    </div>
    
    <!-- Overlay for mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>
    
    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Header -->
        <div class="top-header">
            <div style="display: flex; align-items: center; gap: 15px;">
                <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
                <h2>@yield('page-title', 'Admin Panel')</h2>
            </div>
            <div class="header-actions">
                <span>Welcome, {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('admin.logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-logout">Logout</button>
                </form>
            </div>
        </div>
        
        <!-- Content Area -->
        <div class="content-area">
            @if(session('success'))
                <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #28a745;">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #dc3545;">
                    {{ session('error') }}
                </div>
            @endif
            
            @yield('content')
        </div>
    </div>
    
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('open');
            overlay.classList.toggle('active');
        }
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const toggle = document.querySelector('.menu-toggle');
            
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(event.target) && !toggle.contains(event.target) && sidebar.classList.contains('open')) {
                    sidebar.classList.remove('open');
                    overlay.classList.remove('active');
                }
            }
        });
    </script>
    @stack('scripts')
</body>
</html>

