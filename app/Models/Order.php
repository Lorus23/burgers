<?php

namespace App\Models;

use App\Config\Db;
use PDO;
class Order extends Db
{
    public static function orders()
    {
// Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'SELECT user_id, street, home, part, appt, floor, comment, payment1, payment2, callback FROM order_burger';

        // Получение результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
          $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC);



    }
   public static function zakaz($array1, $id)
    {

        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "INSERT INTO `order_burger` (`user_id`, `street`, `home`, `part`, `appt`, `floor`, `comment`, `payment1`,`payment2`, `callback`) VALUES (:user_id, :street, :home, :part, :appt, :floor, :comment, :payment1, :payment2, :callback)";
        $result = $db->prepare($sql);

        // Получение и возврат результатов. Используется подготовленный запрос
        $values = (object)$array1;
        $result->bindParam(':user_id', $id);
        $result->bindParam(':street', $values->street);
        $result->bindParam(':home', $values->home);
        $result->bindParam(':part', $values->part);
        $result->bindParam(':appt', $values->appt);
        $result->bindParam(':floor', $values->floor);
        $result->bindParam(':comment', $values->comment);
        $result->bindParam(':payment1', $values->payment1);
        $result->bindParam(':payment2', $values->payment2);
        $result->bindParam(':callback', $values->callback);
        $result->execute();
        return $orderId = $db->lastInsertId();
    }
}