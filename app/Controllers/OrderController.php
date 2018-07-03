<?php

namespace App\Controllers;

use App\controllers\MainController;
use App\Models\Order;
use App\Views\View;
use App\Models\User;
use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;

class OrderController extends MainController
{
    public function index()
    {
        if (!empty($_POST)) {
            $data = $_POST;
            $email = strtolower(trim($data['email']));
            $phone = $data['phone'];
            $name = $data['name'];
            $street = $data['street'];
            $home = $data['home'];
            $part = $data['part'];
            $appt = $data['appt'];
            $floor = $_POST['floor'];
            $comment = $data['comment'];

            $data['payment1'] = (!empty($data['payment1'])) ? 'Yes' : 'No';
            $data['payment2'] = (!empty($data['payment2'])) ? 'Yes' : 'No';
            $data['callback'] = (!empty($data['callback'])) ? 'Yes' : 'No';

            $address = sprintf(
                "Улица: %s\nДом: %s\nКорпус: %s\nКвартира: %s\nЭтаж: %s",
                $street,
                $home,
                $part,
                $appt,
                $floor
            );

            $id = User::checkEmailExists($email);
            if ($id < 1) {
                $id = User::register($email, $phone, $name);
            }

            $orderCount = User::getOrderCount($email);

            $orderId = Order::zakaz($data, $id);
            $this->swift($email, $name);

            $this->fileOrder($orderId, $address, ++$orderCount);
            User::updateOrderCount($email);
        }

        // Подключаем вид
        $this->view->render('index');
        return true;
    }

    public function fileOrder($orderId, $address, $orderCount)
    {
        if ($orderCount == 0) {
            $orderCount = 'первый';
        }
        $handle = 'file.html';
        $content = '<table border="1">
        <tr><th>Заказ №' . $orderId . '</th>></tr>' .
            '<tr><td>Ваш заказ будет доставлен по адресу ' . $address . '</td></tr>' .
            '<tr><td>DarkBeefBurger за 500 рублей, 1 шт</td></tr>' .
            '<tr><td>Спасибо - это ваш ' . $orderCount . ' заказ</td></tr>' .
            '</table>';
        file_put_contents($handle, $content);
        header('Location: index.php');
    }

    public function swift($email, $name)
    {
        $transport = (new Swift_SmtpTransport('smtp.mail.ru', '587', 'tls'))
            ->setUsername('enter email')
            ->setPassword('enter-pass');

        $mailer = new Swift_Mailer($transport);

        $message = (new Swift_Message('send by Swift_Mailer'))
            ->setFrom(['sayat020@mail.ru' => 'name'])
            ->setTo([$email => $name])
            ->setBody('Message text');

        $mailer->send($message);
    }

}