<?php

function sidebarActive($url, $contains = true)
{
    if ($contains)
        return (strpos(currentUrl(), $url) === 0) ? 'active' : '';
    else
        return $url === currentUrl() ? 'active' : '';
}


function errorClass($name)
{
    return errorExists($name) ? 'is_invalid' : '';
}


function errorText($name)
{
    return errorExists($name) ? '<div> <smal class="text-danger">' . error($name) . '</smal></div>' : '';
}

function flashText($name)
{
    return flashExists($name) ? '<div> <smal class="text-danger">' . flash($name) . '</smal></div>' : '';
}


function oldOrValue($name, $value)
{
    return empty(old($name)) ? $value : old($name);
}

function oldOrCookie($name)
{
    return empty(old($name)) ? getCookie($name) : old($name);
}

function checkValidValue($feild, $value, $entities = array())
{
    if (in_array($value, $entities) == false) {
        error($feild, $feild . ' not valid');
        return back();
    }
}


function convertToHoursMins($time, $format = '%02d : %02d')
{
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}

function paginate($data, $perPage)
{
    $totalRows = count($data);
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $totalPages = ceil($totalRows / $perPage);
    $currentPage = min($currentPage, $totalPages);
    $currentPage = max($currentPage, 1);
    $currentRow = ($currentPage - 1) * $perPage;
    $data = array_slice($data, $currentRow, $perPage);
    return $data;
}

function paginateView($data, $perPage)
{
    $totalRows = count($data);
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $totalPages = ceil($totalRows / $perPage);
    $currentPage = min($currentPage, $totalPages);
    $currentPage = max($currentPage, 1);

    $paginateView = '';
    $paginateView .= ($currentPage != 1) ? '<li class="page-item"><a class="page-link" href="' . paginateUrl(1) . '">&lt;</a></li>' : '';
    $paginateView .= (($currentPage - 2) >= 1) ? '<li class="page-item"><a class="page-link" href="' . paginateUrl($currentPage - 2) . '">' . ($currentPage - 2) . '</a></li>' : '';
    $paginateView .= (($currentPage - 1) >= 1) ? '<li class="page-item"><a class="page-link" href="' . paginateUrl($currentPage - 1) . '">' . ($currentPage - 1) . '</a></li>' : '';
    $paginateView .= '<li class="page-item active"><a class="page-link" href="' . paginateUrl($currentPage) . '">' . ($currentPage) . '</a></li>';
    $paginateView .= (($currentPage + 1) <= $totalPages) ? '<li class="page-item"><a class="page-link" href="' . paginateUrl($currentPage + 1) . '">' . ($currentPage + 1) . '</a></li>' : '';
    $paginateView .= (($currentPage + 2) <= $totalPages) ? '<li class="page-item"><a class="page-link" href="' . paginateUrl($currentPage + 2) . '">' . ($currentPage + 2) . '</a></li>' : '';
    $paginateView .= ($currentPage != $totalPages) ? '<li class="page-item"><a class="page-link" href="' . paginateUrl($totalPages) . '">&gt;</a></li>' : '';

    return '
    <nav>
    <ul class="pagination justify-content-center">
       ' . $paginateView . '
    </ul>
</nav>
    ';
}

function paginateUrl($page)
{
    $urlArray = explode('?', currentUrl());
    if (isset($urlArray[1])) {

        $_GET['page'] = $page;
        $getVariables = array_map(function ($value, $key) {
            return $key . '=' . $value;
        }, $_GET, array_keys($_GET));
        return $urlArray[0] . '?' . implode('&', $getVariables);
    } else {
        return currentUrl() . '?page=' . $page;
    }
}


function getAllView()
{
    //اختلاف زمانی سرور
    $time_zone = 12600;
    //تاریخ امروز
    $today = date("Y-m-d", time() + $time_zone);
    //تاریخ دیروز
    $yesterday = date("Y-m-d", time() - 86400 + $time_zone);
    //آدرس فایل
    $file_src = 'visit-stats.txt';
    chmod($file_src, 0755);
    //خواندن فایل
    $read_file = file_get_contents($file_src);
    //اگر فایل خالی نبود
    if (filesize($file_src) > 0 || $read_file != '') {
        $split_file = explode('|', $read_file);

        //print_r($split_file);
        $modify = $split_file[3];
        //اگر تاریخ آخرین ویرایش برابر تاریخ امروز نبود
        if ($modify != $today) {
            $today_visit = 1;

            if ($modify == $yesterday) {
                $yesterday_visit = $split_file[0];
            } else {
                $yesterday_visit = 0;
            }

            $total_visit = $split_file[2] + 1;
            $last_modify = $today;
        } //اگر تاریخ آخرین ویرایش برابر امروز بود
        else {
            $today_visit = $split_file[0] + 1;
            $yesterday_visit = $split_file[1];
            $total_visit = $split_file[2] + 1;
            $last_modify = $today;
        }
    } //اگر فایل خالی بود
    else {
        $today_visit = 1;
        $yesterday_visit = 0;
        $total_visit = 1;
        $last_modify = $today;
    }
    //نوشتن آمار جدید در فایل
    $file_src_handle = fopen($file_src, 'w+');
    $visit_data = $today_visit . '|' . $yesterday_visit . '|' . $total_visit . '|' . $last_modify;
    fwrite($file_src_handle, $visit_data);
    fclose($file_src_handle);
    //محاسبه تعداد کاربران آنلاین
    $config_array = array(
        'user_time' => date("YmdHis", time() + $time_zone),
        'user_ip' => $_SERVER['REMOTE_ADDR'],
        'file_name' => 'visit-online.txt'
    );
    chmod($config_array['file_name'], 0755);
    //خواندن اطلاعات فایل
    $online_file = file_get_contents($config_array['file_name']);
    //تجزیه به آرایه
    $online_file = explode("\r\n", $online_file);
    //حذف مقادیر خالی
    foreach ($online_file as $key => $value) {
        if (is_null($value) || $value == '') {
            unset($online_file[$key]);
        }
    }
    //حذف آی پی های قدیمی و آی پی فعلی
    foreach ($online_file as $key => $value) {
        $user_ip_time = explode("|", $value);
        if ($user_ip_time[1] <= date("YmdHis", time() + $time_zone - 300)) {
            unset($online_file[$key]);
        }

        if ($user_ip_time[0] == $config_array['user_ip']) {
            unset($online_file[$key]);
        }
    }
    //محاسبه تعداد افراد آنلاین
    $online = 1;
    foreach ($online_file as $online_users) {
        $user_ip_time = explode("|", $online_users);
        if ($user_ip_time[1] >= date("YmdHis", time() + $time_zone - 300)) {
            $online++;
        }
    }

    //آمار کاربرانی که آنلاین هستند به اضافه کاربر فعلی
    $new_online = $config_array['user_ip'] . "|" . $config_array['user_time'] . "\r\n";
    foreach ($online_file as $key => $value) {
        $new_online .= $value . "\r\n";
    }

    //نوشتن آمار جدید در فایل
    $file_src_handle = fopen($config_array['file_name'], 'w+');
    fwrite($file_src_handle, $new_online);
    fclose($file_src_handle);

    //گرفتن خروجی
    return [
        'today_visit' => $today_visit,
        'yesterday_visit' => $yesterday_visit,
        'total_visit' => $total_visit,
        'online' => $online,
    ];
}
