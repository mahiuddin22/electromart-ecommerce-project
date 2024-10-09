<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>
        <a href="{{route('dashboard')}}" class="sidebar-logo">
            @if(!empty($settings->logo))
            <img src="{{url('public/uploads/system/'.$settings->logo)}}" alt="site logo" class="light-logo">
            @else
            <img src="image" alt="site logo" class="light-logo">
            @endif
        </a>
    </div>
    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">
            <li>
                <a href="{{route('dashboard')}}">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Product Area -->
            <li class="sidebar-menu-group-title">Product Area</li>
            <li>
                <a href="{{route('category')}}">
                    <iconify-icon icon="basil:stack-outline" class="menu-icon"></iconify-icon>
                    <span>Categories</span>
                </a>
            </li>

            <li>
                <a href="{{route('subcategory')}}">
                    <iconify-icon icon="basil:stack-outline" class="menu-icon"></iconify-icon>
                    <span>Sub-Categories</span>
                </a>
            </li>

            <li>
                <a href="{{route('slider')}}">
                    <iconify-icon icon="basil:stack-outline" class="menu-icon"></iconify-icon>
                    <span>Sliders</span>
                </a>
            </li>

            <li>
                <a href="{{route('brand')}}">
                    <iconify-icon icon="basil:stack-outline" class="menu-icon"></iconify-icon>
                    <span>Brands</span>
                </a>
            </li>

            <li>
                <a href="{{route('product')}}">
                    <iconify-icon icon="basil:stack-outline" class="menu-icon"></iconify-icon>
                    <span>Product</span>
                </a>
            </li>

            <!-- Admin Area -->
            <li class="sidebar-menu-group-title">Order Area</li>
            <li>
                <?php $contact_data = \App\Models\Checkout::where('status', 0)->count();?>
                <a href="{{route('admin.order.pending')}}">
                    <iconify-icon icon="basil:stack-outline" class="menu-icon"></iconify-icon>
                    <span>Orders <span class="badge bg-dark text-white radius-5 text-xs">{!! $contact_data >= 1? $contact_data:'0' !!}</span></span>
                </a>
            </li>

            <!-- System Area -->
            <li class="sidebar-menu-group-title">System Area</li>
            <li>
                <a href="{{route('system.aboutus')}}">
                    <iconify-icon icon="basil:stack-outline" class="menu-icon"></iconify-icon>
                    <span>About us</span>
                </a>
            </li>
            <li>
                <a href="{{route('system.site.settings')}}">
                    <iconify-icon icon="basil:stack-outline" class="menu-icon"></iconify-icon>
                    <span>Site Settings</span>
                </a>
            </li>

            <!-- Admin Area -->
            <li class="sidebar-menu-group-title">Admin Area</li>
            <li>
                <?php $contact_data = \App\Models\Contact::where('status', 0)->count();?>
                <a href="{{route('contact.info')}}">
                    <iconify-icon icon="basil:stack-outline" class="menu-icon"></iconify-icon>
                    <span>Contact Info <span class="badge bg-dark text-white radius-5 text-xs">{!! $contact_data >= 1? $contact_data:'0' !!}</span></span>
                </a>
            </li>
            <li>
                <?php $user_data = \App\Models\User::count();?>
                <a href="{{route('user.info')}}">
                    <iconify-icon icon="basil:stack-outline" class="menu-icon"></iconify-icon>
                    <span>User Info <span class="badge bg-dark text-white radius-5 text-xs">{!! $user_data >= 1? $user_data:'0' !!}</span></span>
                </a>
            </li>

        </ul>
    </div>
</aside>