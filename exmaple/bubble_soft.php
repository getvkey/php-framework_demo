<?php


function bubble_soft(array $demo_array)
{
    // 第一层for循环可以理解为从数组中键为0开始循环到最后一个
    for ($i = 0; $i < count($demo_array); $i ++) {
        // 第二层将从键为$i的地方循环到数组最后
        for ($j = $i + 1; $j < count($demo_array); $j ++) {
            // 比较数组中相邻两个值的大小
            if ($demo_array[$i] > $demo_array[$j]) {
                $tmp            = $demo_array[$i]; // 这里的tmp是临时变量
                $demo_array[$i] = $demo_array[$j]; // 第一次更换位置
                $demo_array[$j] = $tmp;            // 完成位置互换
            }
        }
    }

    print_r($demo_array);
}

$arr = [14,16,10,8,2,5,17,20,3,1];
bubble_soft($arr);