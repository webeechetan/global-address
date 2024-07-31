<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

  <div class="app-brand demo ">
    <a href="{{route('admin.dashboard')}}" class="app-brand-link">
      <span class="app-brand-text demo menu-text fw-bold ms-2"> <img src="{{ asset('admin/') }}/assets/img/avatars/company_logo.png" alt="Logo" height="40"></span>
    </a>
    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>  
  <ul class="menu-inner py-1">

     <!-- Apps & Pages -->
    
    <li class="menu-item">
      <a href="{{route('admin.dashboard') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div class="text-truncate" data-i18n="Dashboard">Dashboard</div>
      </a>
    </li>

    <!-- Category -->
    {{-- <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-collection"></i>
       
        <div class="text-truncate" data-i18n="Category">Category</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item active">
          <a href="{{ route('admin.category.index') }}" class="menu-link">
            <div class="text-truncate" data-i18n="All Category">All Category</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="{{ route('admin.category.create') }}" class="menu-link">
            <div class="text-truncate" data-i18n="New Category">New Category</div>
          </a>
        </li>
       
      </ul>
    </li> --}}

     <!-- Category -->
    {{-- <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-collection"></i>
        
        <div class="text-truncate" data-i18n="Sub-Category">Sub-Category</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item active">
          <a href="{{route('subcategory.index')}}" class="menu-link">
            <div class="text-truncate" data-i18n="Sub-Category">Sub-Category</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="{{route('subcategory.create')}}" class="menu-link">
            <div class="text-truncate" data-i18n="New SubCategory">New SubCategory</div>
          </a>
        </li>
        
      </ul>
    </li> --}}
   
       <!-- Product -->
    {{-- <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-collection"></i>
        
        <div class="text-truncate" data-i18n="Product">Products</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item active">
          <a href="{{route('product.index')}}" class="menu-link">
            <div class="text-truncate" data-i18n="Product List">Product List</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="{{route('product.create')}}" class="menu-link">
            <div class="text-truncate" data-i18n="New Product">New Product</div>
          </a>
        </li>
        
      </ul>
    </li> --}}

    <li class="menu-item">
      <a href="{{route('admin.contact')}}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-message-rounded-dots"></i>
        <div class="text-truncate" data-i18n="Contact">Contacts Us</div>
      </a>
    </li>
     
    
  </ul>
  
  

</aside>