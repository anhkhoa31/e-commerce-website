<?php
    function push_user_data($new_data, $file_path) {
        if (!file_exists($file_path)) {
            $file = fopen($file_path, 'w');
            fwrite($file, "[]");
            fclose($file);
        }
        $file = fopen($file_path, 'w');
        fwrite($file, $new_data);
        fclose($file);
    }

    function fetch_user_data($file_path) {
        if (!file_exists($file_path)) {
            push_user_data("[]", $file_path);
        }
        $str_fetched_data = file_get_contents($file_path);
        $arr_fetched_data = json_decode($str_fetched_data, true);
        return $arr_fetched_data;
    }
    function get_user($user_name, $file_path) {
        $users = fetch_user_data($file_path);
        foreach ($users as $user) {
            if ($user_name == $user["username"]) {
                return $user;
            }
        }
        return false;
    }

    function get_vendor_user($file_path) {
        $users = fetch_user_data($file_path);
        $vendors = [];

        foreach ($users as $user) {
            if ($user['role'] == 'vendor') {
                array_push($vendors, $user);
            }
        }
        return $vendors;
    }
    
    function update_user($username, $attribute_key, $attribute_value, $file_path) {
        $users = fetch_user_data($file_path);
        foreach ($users as &$user) {
            if ($user['username'] == $username) {
                $user[$attribute_key] = $attribute_value;
                $data = json_encode($users);
                push_user_data($data, $file_path);
                return true;
            }
        }
        return false;
    }

    function add_user($new_user, $file_path) {
        $users = fetch_user_data($file_path);
        array_push($users, $new_user);
        $data = json_encode($users);
        push_user_data($data, $file_path);
    }
?>