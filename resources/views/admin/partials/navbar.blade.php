<div class="row" style="border-bottom: 1px solid #ddd;">
    <div class="col-md-12 mt-2 mb-2 d-flex justify-content-end">
      
        <div class="dropdown mr-3 nav-user-dropdown">
                <button 
                    class="btn rounded-circle p-0 nav-user-dropdown-btn" 
                    type="button" 
                    data-bs-toggle="dropdown" 
                    aria-expanded="false" 
                    style="background-color: #001f3f; border: none; color: white"
                >
                <i class="fas fa-user fa-sm "></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="profileSettingMenu">
                <a class="dropdown-item" href="{{ route('dashboard') }}" style="font-size: 14px;font-weight: 700;color: #001f3f;font-family: serif; border-bottom: 1px solid #cbcbcb; text-align:center;">
                    <i class="fa-solid fa-gauge mr-1" style="margin-right: 2px;"></i> Dashboard
                </a>
                <a class="dropdown-item" href="#" style="font-size: 14px;font-weight: 700;color: #001f3f;font-family: serif; border-bottom: 1px solid #cbcbcb; text-align:center;">
                    <i class="fa-solid fa-gear" style="margin-right: 3px;"></i>Settings
                </a>

                <a class="dropdown-item" href="{{ route('logout') }}" style="font-size: 14px;font-weight: 700;color: #001f3f;font-family: serif; text-align:center;">
                    <i class="fa-regular fa-circle-left" style="margin-right: 5px;"></i>Logout
                </a>
            </div>
        </div>
    </div>
</div>
