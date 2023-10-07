 
<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- User Profile-->
                <li class="sidebar-item pt-2">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('home') }}"
                        aria-expanded="false">
                        <div class="svg-icon">@include('layouts.partials.svgs.dashboard')</div>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('products.index') }}"
                        aria-expanded="false">
                        <div class="svg-icon">@include('layouts.partials.svgs.product')</div>
                        <span class="hide-menu">Products</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('areas.index') }}"
                        aria-expanded="false">
                        <div class="svg-icon">@include('layouts.partials.svgs.area')</div>
                        <span class="hide-menu">Areas</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('order-bookers.index') }}"
                        aria-expanded="false">
                        <div class="svg-icon">@include('layouts.partials.svgs.order-booker')</div>
                        <span class="hide-menu">Order Bookers</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('shop-types.index') }}"
                        aria-expanded="false">
                        <div class="svg-icon">@include('layouts.partials.svgs.shop-types')</div>
                        <span class="hide-menu">Shop Types</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('shops.index') }}"
                        aria-expanded="false">
                        <div class="svg-icon">@include('layouts.partials.svgs.shop')</div>
                        <span class="hide-menu">Shops</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('bills.index') }}"
                        aria-expanded="false">
                        <div class="svg-icon">@include('layouts.partials.svgs.bills')</div>
                        <span class="hide-menu">Bills</span>
                    </a>
                </li>
                
            </ul>

        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside> 
