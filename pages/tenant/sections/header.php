<header class="position-fixed w-100 header ">
    <div class="container py-3 bg-white d-flex flex-row align-items-center justify-content-between header-container">
        <a href="/rentrover/tenant/home">
            <img src="/rentrover/assets/brands/rentrover-rectangular-logo.png" alt="">
        </a>

        <div class="d-flex flex-row gap-4 align-items-center wishlist-notification-profile">
            <!-- wishlist -->
            <div class="position-relative wishlist-container pointer"
                onclick="window.location.href='/rentrover/tenant/wishlist'">
                <a href="/rentrover/tenant/wishlist" class="text-secondary">
                    <i class="fa-regular fa-bookmark pt-1"></i>
                </a>

                <div
                    class="position-absolute d-flex flex-row align-items-center justify-content-center wishlist-counter">
                    <p class="m-0 text-danger fw-semibold"> 9<sup>+</sup></p>
                </div>
            </div>

            <!-- notification -->
            <div class="position-relative notification-section">
                <div class="position-relative notification-icon pointer" id="notification-icon">
                    <i class="fa-regular fa-bell fs-5 pt-1 text-secondary pointer"></i>
                    <div class="position-absolute text-danger fw-semibold notification-counter"> 9<sup>+</sup></div>
                </div>

                <!-- container -->
                <div class="position-absolute flex-column shadow notification-container" id="notification-container">
                    <div class="d-flex flex-row justify-content-between p-3 border-bottom notification-heading">
                        <div class="heading">
                            <h5 class="m-0"> Notifications </h5>
                            <a href="/rentrover/tenant/notifications" class="text-primary small"> See all </a>
                        </div>
                        <i class="fa fa-multiply fs-5 pointer" id="notification-close"></i>
                    </div>
                    <!-- notification 1 -->
                    <div class="d-flex flex-row gap-2 notification">
                        <!-- icon -->
                        <div class="notification-icon">
                            <img src="/rentrover/assets/icons/verified.png" alt="">
                        </div>

                        <!-- details -->
                        <div class="notification-details">
                            <!-- detail -->
                            <p class="m-0 small"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus,
                                numquam? </p>

                            <!-- date -->
                            <p class="m-0 small text-secondary"> 0000-00-00 00:00:00 </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- profile -->
            <div class="position-relative profile-container">
                <div class="profile" id="profile-image-container">
                    <img src="/rentrover/assets/images/bishal.jpg" alt="user profile photo" class="pointer">
                </div>

                <!-- user menu -->
                <div class="position-absolute shadow-sm profile-menu" id="profile-menu">
                    <ul>
                        <li onclick="window.location.href='/rentrover/tenant/profile'">
                            <i class="fa fa-user"></i> <span> My Profile </span>
                        </li>
                        <li onclick="window.location.href='/rentrover/tenant/profile/my-room'"> <i
                                class="fa-solid fa-person-shelter"></i> <span> My Room </span> </li>
                        <li onclick="window.location.href='/rentrover/pages/tenant/app/logout.php'"> <i
                                class="fa-solid fa-arrow-right-from-bracket"></i> <span> Logout </span> </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>