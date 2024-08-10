<?php
$redirected = false;
if (session_status() == PHP_SESSION_NONE)
    session_start();

$r_id = '';
$r_role = '';

if (isset($_SESSION['rentrover-id']) && isset($_SESSION['rentrover-role'])) {
    $r_id = $_SESSION['rentrover-id'];
    $r_role = $_SESSION['rentrover-role'];
}

$request = $_SERVER['REQUEST_URI'];
$router = str_replace('/rentrover', '', $request);

$arr = explode('/', $router);

$unsignedUserPages = ['', 'landing', 'index', 'home', 'login', 'registration', 'password-recovery', 'room-detail'];

// // unsigned user
if (in_array($arr[1], $unsignedUserPages)) {
    if($r_role != ''){
        if ($r_role == "admin"){
            header("Location: /rentrover/admin/dashboard");
            exit;
        } elseif ($r_role == "landlord") {
            header("Location: /rentrover/landlord/dashboard");        
            exit;
        } elseif ($r_role == "tenant") {
            header("Location: /rentrover/tenant/home");        
            exit;
        }
    }

    if ($arr[1] == '' || $arr[1] == 'home' || $arr[1] == 'landing' || $arr[1] == 'index' || $arr[1] == 'registration' || $arr[1] == 'login' || $arr[1] == 'password-recovery') {
        switch ($arr[1]) {
            case '':
                require_once __DIR__ . '/landing.php';
                $redirected = true;
                break;
            case 'home':
            case 'index':
                header('Location: /rentrover/');
                $redirected = true;
                break;
            case 'registration':
                require_once __DIR__ . '/registration.php';
                $redirected = true;
                break;
            case 'login':
                require_once __DIR__ . '/login.php';
                $redirected = true;
                break;
            case 'password-recovery':
                require_once __DIR__ . '/password-recovery.php';
                $redirected = true;
                break;
            default:
                require_once __DIR__ . '/landing.php';
                $redirected = true;
        }
    } elseif ($arr[1] == 'room-detail') {
        if (isset($arr[2])) {
            if ($arr['2'] != '') {
                $roomId = $arr[2];
                require_once __DIR__ . '/room-detail.php';
                $redirected = true;
            } else {
                header("Location: /rentrover/");
            }
        } else {
            header("Location: /rentrover/");
        }
    }
} elseif ($arr[1] == "tenant") {
    if($r_role != 'tenant'){
        if ($r_role == "admin") {
            header("Location: /rentrover/admin/dashboard");
            exit;
        } elseif ($r_role == "landlord") {
            header("Location: /rentrover/landlord/dashbord");        
            exit;
        } else {
            header("Location: /rentrover/");        
            exit;
        }
    }

    $tenantPages = ['', 'home', 'notifications', 'profile', 'room-detail', 'system-notice'];
    if (isset($arr[2])) {
        $page = ($arr[2] != '') ? $arr[2] : "home";
    } else {
        $page = "home";
    }

    switch ($page) {
        case 'home':
        case '':
            require_once __DIR__ . '/pages/tenant/home.php';
            $redirected = true;
            break;
        case 'wishlist':
            require_once __DIR__ . '/pages/tenant/wishlist.php';
            $redirected = true;
            break;
        case 'notifications':
            require_once __DIR__ . '/pages/tenant/notifications.php';
            $redirected = true;
            break;
        case 'room-detail':
            if (isset($arr[3])) {
                if ($arr[3] != '') {
                    $roomId = $arr[3];
                    $redirected = true;
                    require_once __DIR__ . '/pages/tenant/room-detail.php';
                }
            }
            break;
        case 'profile':
            if (isset($arr[3])) {
                $tab = $arr[3] != '' ? $arr[3] : "view";
                $redirected = true;
                require_once __DIR__ . '/pages/tenant/profile.php';
            } else {
                $tab = "view";
                $redirected = true;
                require_once __DIR__ . '/pages/tenant/profile.php';
            }
            break;
        default:
            $redirected = false;
    }
} elseif ($arr[1] == "landlord") {
    if($r_role != 'landlord'){
        if ($r_role == "admin")
            header("Location: /rentrover/admin/dashboard");
        elseif ($r_role == "tenant")
            header("Location: /rentrover/tenant/home");        
        else
            header("Location: /rentrover/");        
    }

    if (isset($arr[2])) {
        $page = ($arr[2] != '') ? $arr[2] : "dashboard";
    } else {
        $page = "dashboard";
    }

    switch ($page) {
        case 'dashboard':
        case '':
            require_once __DIR__ . '/pages/landlord/dashboard.php';
            $redirected = true;
            break;
        case 'notifications':
            require_once __DIR__ . '/pages/landlord/notifications.php';
            $redirected = true;
            break;
        case 'houses':
            require_once __DIR__ . '/pages/landlord/houses.php';
            $redirected = true;
            break;
        case 'house-detail':
            if (isset($arr[3])) {
                if ($arr[3] != '') {
                    $houseId = $arr[3];
                    require_once __DIR__ . '/pages/landlord/house-detail.php';
                } else {
                    require_once __DIR__ . '/pages/landlord/houses.php';
                }
                $redirected = true;
            } else {
                header("Location: /rentrover/landlord/houses");
                $redirected = true;
            }
            break;
        case 'add-house':
            require_once __DIR__ . '/pages/landlord/add-house.php';
            $redirected = true;
            break;
        case 'edit-house':
            if(!isset($arr[3])) {
                header("Location: /rentrover/landlord/houses/");
            } else {
                $houseId = $arr[3];
                require_once __DIR__ . '/pages/landlord/edit-house.php';
                $redirected = true;
            }
            break;
        case 'rooms':
            require_once __DIR__ . '/pages/landlord/rooms.php';
            $redirected = true;
            break;
        case 'add-room':
            require_once __DIR__ . '/pages/landlord/add-room.php';
            $redirected = true;
            break;
        case 'edit-room':
            if(!isset($arr[3])) {
                header("Location: /rentrover/landlord/rooms/");
            } else {
                $roomId = $arr[3];
                if($roomId == '') {
                    header("Location: /rentrover/landlord/rooms/");
                }
                require_once __DIR__ . '/pages/landlord/edit-room.php';
                $redirected = true;
            }
            break;

        case 'room-detail':
            if (isset($arr[3])) {
                if ($arr[3] != '') {
                    $roomId = $arr[3];
                    $redirected = true;
                    require_once __DIR__ . '/pages/landlord/room-detail.php';
                } else {
                    header("Location: /rentrover/landlord/rooms");
                }
            } else {
                header("Location: /rentrover/landlord/rooms");
            }
            break;
        case 'tenants':
            require_once __DIR__ . '/pages/landlord/tenants.php';
            $redirected = true;
            break;
        case 'tenant-detail':
            if (isset($arr[3])) {
                if ($arr[3] != '') {
                    $tenantId = $arr[3];
                    require_once __DIR__ . '/pages/landlord/tenant-detail.php';
                    $redirected = true;
                }
            }
            if (!$redirected)
                header("Location: /rentrover/landlord/tenants");
            break;
        case 'issues':
            require_once __DIR__ . '/pages/landlord/issues.php';
            $redirected = true;
            break;
        case 'room-applications':
            require_once __DIR__ . '/pages/landlord/room-applications.php';
            $redirected = true;
            break;
        case 'leave-applications':
            require_once __DIR__ . '/pages/landlord/leave-applications.php';
            $redirected = true;
            break;
        case 'notices':
            require_once __DIR__ . '/pages/landlord/notices.php';
            $redirected = true;
            break;
        case 'profile':
            if (isset($arr[3])) {
                if ($arr[3] != '') {
                    if ($arr[3] == "view" || $arr[3] == "edit" || $arr[3] == "password-change") {
                        $tab = $arr[3];
                        $redirected = true;
                        require_once __DIR__ . '/pages/landlord/profile.php';
                    }
                }
            }
            if (!$redirected) {
                header("Location: /rentrover/landlord/profile/view");
            }
            break;
        default:
            $redirected = false;
    }
} elseif ($arr[1] == "admin") {
    if (isset($_SESSION['rentrover-role'])) {
        if ($r_role == "landlord")
            header("Location: /rentrover/landlord/dashboard");
        elseif ($r_role == "tenant")
            header("Location: /rentrover/tenant/home");
    }

    if (isset($arr[2])) {
        $page = ($arr[2] != '') ? $arr[2] : "dashboard";
    } else {
        $page = "dashboard";
    }


    $adminPages = ['dashboard', 'notifications', 'houses', 'house-detail', 'rooms', 'room-detail', 'users', 'user-details', 'feedbacks', 'notices', 'custom-applications', 'profile'];

    if (in_array($page, $adminPages)) {
        if (!isset($_SESSION['rentrover-role'])) {
            header("Location: /rentrover/admin/login");
        }
    }

    switch ($page) {
        case 'dashboard':
        case '':
            require_once __DIR__ . '/pages/admin/dashboard.php';
            $redirected = true;
            break;
        case 'registration':
            require_once __DIR__ . '/pages/admin/registration.php';
            $redirected = true;
            break;
        case 'login':
            require_once __DIR__ . '/pages/admin/login.php';
            $redirected = true;
            break;
        case 'notifications':
            require_once __DIR__ . '/pages/admin/notifications.php';
            $redirected = true;
            break;
        case 'houses':
            require_once __DIR__ . '/pages/admin/houses.php';
            $redirected = true;
            break;
        case 'house-detail':
            if (isset($arr[3])) {
                if ($arr[3] != '') {
                    $houseId = $arr[3];
                    require_once __DIR__ . '/pages/admin/house-detail.php';
                } else {
                    require_once __DIR__ . '/pages/admin/houses.php';
                }
                $redirected = true;
            } else {
                header("Location: /rentrover/admin/houses");
                $redirected = true;
            }
            break;
        case 'rooms':
            require_once __DIR__ . '/pages/admin/rooms.php';
            $redirected = true;
            break;
        case 'room-detail':
            if (isset($arr[3])) {
                if ($arr[3] != '') {
                    $roomId = $arr[3];
                    $redirected = true;
                    require_once __DIR__ . '/pages/admin/room-detail.php';
                } else {
                    header("Location: /rentrover/admin/rooms");
                }
            } else {
                header("Location: /rentrover/admin/rooms");
            }
            break;
        case 'users':
            require_once __DIR__ . '/pages/admin/users.php';
            $redirected = true;
            break;
        case 'user-detail':
            if (isset($arr[3])) {
                if ($arr[3] != '') {
                    $userId = $arr[3];
                    require_once __DIR__ . '/pages/admin/user-detail.php';
                    $redirected = true;
                }
            }
            if (!$redirected)
                header("Location: /rentrover/admin/users");
            break;
        case 'feedbacks':
            require_once __DIR__ . '/pages/admin/feedbacks.php';
            $redirected = true;
            break;

        case 'notices':
            require_once __DIR__ . '/pages/admin/notices.php';
            $redirected = true;
            break;

        case 'custom-applications':
            require_once __DIR__ . '/pages/admin/custom-applications.php';
            $redirected = true;
            break;

        case 'profile':
            if (isset($arr[3])) {
                if ($arr[3] != '') {
                    if ($arr[3] == "view" || $arr[3] == "edit" || $arr[3] == "password-change") {
                        $tab = $arr[3];
                        $redirected = true;
                        require_once __DIR__ . '/pages/admin/profile.php';
                    }
                }
            }
            if (!$redirected) {
                header("Location: /rentrover/admin/profile/view");
            }
            break;
        default:
            $redirected = false;
    }
} else {
    // header("Location: /rentrover/");
}

if (!$redirected) {
    require_once __DIR__ . '/404.php';
}

exit;