<?php
function setCookie($companyId, $product_id, $recent_visited_key, $most_visited_key)
{

    $com_prod_id = $companyId . "_" . $product_id;
    if (!isset($_COOKIE[$recent_visited_key])) {
        $recent_visited_arr = array($com_prod_id);
    } else {
        $recent_visited_arr = json_decode($_COOKIE[$recent_visited_key], false);

        $index = array_search($com_prod_id, $recent_visited_arr, true);

        if ($index !== false && $index >= 0) {
            // remove the already existed product id
            unset($recent_visited_arr[$index]);

        } else if (count($recent_visited_arr) >= 5) {
            array_pop($recent_visited_arr);
        }

        // add product id to the beginning of the array
        array_unshift($recent_visited_arr, $com_prod_id);
    }

    setcookie($recent_visited_key, json_encode($recent_visited_arr), time() + (86400 * 30)); // 86400 = 1 day

    $product_id_str = 'i_' . $com_prod_id;
    if (!isset($_COOKIE[$most_visited_key])) {
        $most_visited_arr = array($product_id_str => 1);
    } else {
        $most_visited_arr = json_decode($_COOKIE[$most_visited_key], true);

        if (isset($most_visited_arr[$product_id_str])) {
            $most_visited_arr[$product_id_str]++;
        } else {
            $temps_arr = array($product_id_str => 1);
            $most_visited_arr = array_merge($most_visited_arr, $temps_arr);
        }
    }

    setcookie($most_visited_key, json_encode($most_visited_arr, JSON_FORCE_OBJECT), time() + (86400 * 30)); // 86400 = 1 day
}