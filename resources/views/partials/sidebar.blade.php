 <aside id="sidebar" class="shadow">
     <div class="d-flex">
         <button class="toggle-btn" type="button">
             <i class="bi bi-grid"></i>
         </button>
         <div class="sidebar-logo">
             <a class="navbar-brand" href="{{ route('user-dashboard') }}">Capetang</a>
         </div>
     </div>
     <hr class="text-white">
     <ul class="sidebar-nav">
         <li class="sidebar-item">
             <a href="{{ route('user-dashboard') }}" class="sidebar-link">
                 <i class="bi bi-columns-gap"></i>
                 <span>Dashboard</span>
             </a>
         </li>
         <li class="sidebar-item">
             <a href="{{ route('user-kategori-sampah') }}" class="sidebar-link">
                 <i class="bi bi-recycle"></i>
                 <span>Kategori Sampah</span>
             </a>
         </li>
         <li class="sidebar-item">
             <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                 data-bs-target="#quest" aria-expanded="false" aria-controls="quest">
                 <i class="bi bi-bookmarks-fill"></i>
                 <span>Quest</span>
             </a>
             <ul id="quest" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                 <li class="sidebar-item">
                     <a href="{{ route('user-all-quest') }}" class="sidebar-link">Semua Quest</a>
                     <span
                         class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                         <span class="visually-hidden">New alerts</span>
                 </li>
                 <li class="sidebar-item">
                     <a href="{{ route('user-quest') }}" class="sidebar-link">Quest Anda</a>
                     <span
                         class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                         <span class="visually-hidden">New alerts</span>
                 </li>
             </ul>
         </li>
         <li class="sidebar-item">
             <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                 data-bs-target="#reward" aria-expanded="false" aria-controls="reward">
                 <i class="bi bi-coin"></i>
                 <span>Reward</span>
             </a>
             <ul id="reward" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                 <li class="sidebar-item">
                     <a href="{{ route('reward-poin') }}" class="sidebar-link">Reward Point</a>
                     <span
                         class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                         <span class="visually-hidden">New alerts</span>
                 </li>
                 <li class="sidebar-item">
                     <a href="{{ route('riwayat-tukar-poin') }}" class="sidebar-link">Riwayat Tukar Point</a>
                     <span
                         class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                         <span class="visually-hidden">New alerts</span>
                 </li>
             </ul>
         </li>
         <li class="sidebar-item">
             <a href="{{ route('tukar-poin') }}" class="sidebar-link">
                 <i class="bi bi-arrow-left-right"></i>
                 <span>Tukar Point</span>
             </a>
         </li>
         <li class="sidebar-item">
             <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                 data-bs-target="#setting" aria-expanded="false" aria-controls="setting">
                 <i class="bi bi-gear-fill"></i>
                 <span>Setting</span>
             </a>
             <ul id="setting" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                 <li class="sidebar-item">
                     <a href="{{ route('user-profile') }}" class="sidebar-link">Profile</a>
                 </li>
                 <li class="sidebar-item">
                     <a href="{{ route('user-authentication') }}" class="sidebar-link">Authentication</a>
                 </li>
             </ul>
         </li>
     </ul>
     <div class="sidebar-footer">
         <a href="#" class="sidebar-link">
             <i class="bi bi-box-arrow-left"></i>
             <span>Logout</span>
         </a>
     </div>
 </aside>
