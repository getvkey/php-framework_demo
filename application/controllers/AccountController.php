<?php

namespace application\controllers;

use application\core\Controller;

use Curl\Curl;
use GuzzleHttp\Client;

class AccountController extends Controller {

    protected $fieldData = [
        [
            'name' => 'peter',
            'addr' => 'shenzhen'
        ],
        [
            'name' => '',
            'addr' => 'shenzhen2'
        ],
        [
            'name' => 'peter3',
            'addr' => 'shenzhen3'
        ]
    ];

	public function loginAction() {
        if (is_get()) {
            return $this->view->render('登录');
        }
        debug($_POST);
	}

	public function registerAction() {
        if (is_get()) {
            return $this->view->render('注册');
        }
        debug($_POST);
	}

	public function testsAction()
	{
        /* $curl = new Curl();

        $curl->get('http://httpbin.org/get?name=danny');
		if ($curl->error) {
            echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
        } else {
            echo 'Response:' . "\n";
            var_dump($curl->response);
        } */

        $client = new Client();
        $res = $client->request('GET', 'http://httpbin.org/get?name=danny');
        // print_r($res);
        //echo $res->getStatusCode();

        //
        $temp = array_map(function ($item) {
            $name = $item['name'] ?? '';
            $addr = $item['addr'] ?? '';
            return [
                'name' => $name,
                'addr' => $addr
            ];
        }, $this->fieldData);

        $temp = array_filter($temp, function ($item) {
            return !empty($item['name']); //过滤name值空的数组
        });
        $temp = array_values($temp); //使数字下标连续
        debug($temp);
	}
}