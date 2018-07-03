<?php

namespace App\Models;

use PDO;
use App\Config\Db;

class User extends Db
{
    public static function usersList()
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'SELECT username, email, phone FROM users';

        // Получение результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);

        $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC);

    }

    public static function checkEmailExists($email)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM users WHERE email = :email';

        // Получение результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email);
        $result->setFetchMode();
        $result->execute();
        $id = $result->fetch();
        $_SESSION['username'] = $id['username'];

        if ($id) {
            return $id['id'];
        } else {
            return false;
        }
    }

    public static function register($email, $phone, $name)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO users (username, email, phone) VALUES (:name, :email, :phone)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name);
        $result->bindParam(':email', $email);
        $result->bindParam(':phone', $phone);

        //Execute the statement and insert our values.
        $result->execute();

        return $id = $db->lastInsertId();
    }

    public static function getOrderCount($email)
    {
// Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM users WHERE email = :email';

        // Получение результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $id = $result->fetch();

        if ($id) {
            return $id['orderCount'];
        } else {
            return false;
        }
    }

    public static function updateOrderCount($email)
    {
// Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM users WHERE email = :email';

        // Получение результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $id = $result->fetch();

        $orderId = $id['orderCount'] + 1;
        $sqlUpdate = 'UPDATE `users` SET `orderCount`=' . $orderId . ' WHERE `id`=' . $id['id'];

// Получение результатов. Используется подготовленный запрос
        $result1 = $db->prepare($sqlUpdate);
        $result1->setFetchMode(PDO::FETCH_ASSOC);
        $result1->execute();
        $result1->fetch();
        return $result1;
    }


}