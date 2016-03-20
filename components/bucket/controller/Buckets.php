<?php
/**
 * Created by PhpStorm.
 * User: opsat73
 * Date: 20.03.16
 * Time: 11:09
 */

namespace components\bucket\controller;

use core\Controller;
use core\ServiceLocator;

class Buckets extends Controller {

    public function actionAddProduct ($context = array())
    {
        $session_id = ServiceLocator::get('core:Session')->get_session_id();
        $this->getModel();
        $bucket_info = $this->model->addProduct($context[product_id], $session_id, $context[count], $context[mode]);
        $session = ServiceLocator::get('core:Session');
        $session->putParameter('count', $bucket_info[count]);
        $session->putParameter('total_price', $bucket_info[total_price]);
        echo json_encode($bucket_info);
        die();
    }

    public function actionShowBucket($context = array())
    {
        $session = ServiceLocator::get('core:Session');
        $session_id = $session->get_session_id();
        $this->getModel();
        $list = $this->model->getOrderInfo($session_id);
        $this->assignParameter('list', $list);
        $this->assignParameter ('count_total', $session->getParameter('count'));
        $this->assignParameter ('total_price', $session->getParameter('total_price'));

        $this->getView('bucket');
    }

    public function actionShowOrdered($context = array())
    {
        $this->getModel();
        $list = $this->model->getOrdered($context[1]);
        $this->assignParameter('list', $list);
        $this->getView('ordered');
    }

    public function actionOrder($context = array())
    {
        $session = ServiceLocator::get('core:Session');
        $session_id = $session->get_session_id();
        $this->getModel();
        $order_uid = $this->model->processOrder($context[consumer_first_name],
                                           $context[consumer_last_name],
                                           $context[description],
                                           $context[consumer_email],
                                           $context[consumer_phone],
                                           $session_id);
        $session->removeParameter('count');
        $session->removeParameter('total_price');
        $mailer = ServiceLocator::get('serv:mailer');

        $subject = "You New Order";
        $body =  $context[consumer_first_name].' '. $context[consumer_last_name].' http://shop.hz/bucket/'.$order_uid;
        $mailer->sendEmail('vkorovay@mindk.com', $context[consumer_email], $subject, $body);
        header("Location: http://shop.hz/");
    }
}