<!--begin::Header-->
<nav class="app-header navbar navbar-expand bg-body">
  <!--begin::Container-->
  <div class="container-fluid">
    <!--begin::Start Navbar Links-->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
          <i class="bi bi-list"></i>
        </a>
      </li>
    </ul>
    <!--end::Start Navbar Links-->
    <!--begin::End Navbar Links-->
    <ul class="navbar-nav ms-auto">
      <!--begin::Notifications Dropdown Menu-->
      <li class="nav-item dropdown">
        <a class="nav-link" data-bs-toggle="dropdown" href="#">
          <i class="bi bi-bell-fill"></i>
          <span class="navbar-badge badge text-bg-warning">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
          <span class="dropdown-item dropdown-header">15 Thông báo</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="bi bi-envelope me-2"></i> 4 tin nhắn mới
            <span class="float-end text-secondary fs-7">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="bi bi-people-fill me-2"></i> 8 Liên hệ mới
            <span class="float-end text-secondary fs-7">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="bi bi-file-earmark-fill me-2"></i> 3 báo cáo mới
            <span class="float-end text-secondary fs-7">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer"> Xem tất cả thông báo </a>
        </div>
      </li>
      <!--end::Notifications Dropdown Menu-->
      <!--begin::Fullscreen Toggle-->
      <li class="nav-item">
        <a class="nav-link" href="#" data-lte-toggle="fullscreen">
          <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
          <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
        </a>
      </li>
      <!--end::Fullscreen Toggle-->
      <!--begin::User Menu Dropdown-->
      <?php if (isLoggedIn()): ?>
        <?php $currentUser = getCurrentUser(); ?>
        <li class="nav-item dropdown user-menu">
          <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
            <?php if (isAdmin()): ?>
            <img
              id="headerAvatar"
              src="<?= isset($_SESSION['user_avatar_' . getCurrentUser()->id]) ? $_SESSION['user_avatar_' . getCurrentUser()->id] : asset('dist/assets/img/user2-160x160.jpg') ?>"
              class="user-image rounded-circle shadow"
              alt="User Image"
              style="object-fit: cover;"
            />
            <?php else: ?>
            <img
              id="headerAvatar"
              src="<?= asset('dist/assets/img/avatar.png') ?>"
              class="user-image rounded-circle shadow"
              alt="User Image"
              style="object-fit: cover;"
            />
            <?php endif; ?>
            <span class="d-none d-md-inline"><?= $currentUser->name ?></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
            <!--begin::User Image-->
            <li class="user-header text-bg-primary">
              <?php if (isAdmin()): ?>
              <img
                id="dropdownAvatar"
                src="<?= isset($_SESSION['user_avatar_' . getCurrentUser()->id]) ? $_SESSION['user_avatar_' . getCurrentUser()->id] : asset('dist/assets/img/user2-160x160.jpg') ?>"
                class="rounded-circle shadow"
                alt="User Image"
                style="object-fit: cover; width: 90px; height: 90px;"
              />
              <?php else: ?>
              <img
                id="dropdownAvatar"
                src="<?= asset('dist/assets/img/avatar.png') ?>"
                class="rounded-circle shadow"
                alt="User Image"
                style="object-fit: cover; width: 90px; height: 90px;"
              />
              <?php endif; ?>
              <p>
                <?= $currentUser->name ?>
                <small class="d-block"><?= getUserTypeLabel() ?></small>
                <small><?= date('M. Y') ?></small>
              </p>
            </li>
            <!--end::User Image-->
            <!--begin::Menu Body-->
            
            <!--end::Menu Body-->
            <!--begin::Menu Body-->
            <li class="user-body">
              <div class="row">
                <div class="col-12 text-center">
                  <small class="text-muted">ID: #<?= $currentUser->id ?></small><br>
                  <small class="text-muted">Email: <?= $currentUser->email ?></small>
                </div>
              </div>
            </li>
            <!--end::Menu Body-->
            <!--begin::Menu Footer-->
            <li class="user-footer">
              <a href="<?= BASE_URL ?>profile" class="btn btn-default btn-flat">
                <i class="bi bi-person-circle me-1"></i>Tài khoản
              </a>
              <a href="<?= BASE_URL . 'logout' ?>" class="btn btn-default btn-flat float-end">
                <i class="bi bi-box-arrow-right me-1"></i>Đăng xuất
              </a>
            </li>
            <!--end::Menu Footer-->
          </ul>
        </li>
      <?php endif; ?>
      <!--end::User Menu Dropdown-->
    </ul>
    <!--end::End Navbar Links-->
  </div>
  <!--end::Container-->
</nav>
<!--end::Header-->

