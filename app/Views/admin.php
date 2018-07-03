<?php
echo '<table border="2" > <tr>';
echo '<tr>    <th>Имя пользователя</th>    <th>Улица</th>    <th>Дом</th> <th>Корпус</th> <th>Квартира</th> <th>Этаж</th> <th>Комментарий</th> <th>Потребуется сдача
</th> <th>Оплата по карте</th> <th>Не перезванивать</th>  </tr>';
while ($row = $data['orders']) {
    // Оператором echo выводим на экран поля таблицы name_blog и text_blog
    echo '<tr>';
    echo '<td>' . $row['user_id'] . '</td>';
    echo '<td>' . $row['street'] . '</td>';
    echo '<td>' . $row['home'] . '</td>';
    echo '<td>' . $row['part'] . '</td>';
    echo '<td>' . $row['appt'] . '</td>';
    echo '<td>' . $row['floor'] . '</td>';
    echo '<td>' . $row['comment'] . '</td>';
    echo '<td>' . $row['payment1'] . '</td>';
    echo '<td>' . $row['payment2'] . '</td>';
    echo '<td>' . $row['callback'] . '</td>';
    echo '</tr>';
}
echo '</table>';

echo '<table border="2"> <tr>';
echo '<tr>    <th>Имя пользователя</th>    <th>Электронная почта</th>    <th>Телефон</th>  </tr>';
while ($row = $data['users']) {
    // Оператором echo выводим на экран поля таблицы name_blog и text_blog
    echo '<tr>';
    echo '<td>' . $row['username'] . '</td>';
    echo '<td>' . $row['email'] . '</td>';
    echo '<td>' . $row['phone'] . '</td>';
    echo '</tr>';
}
echo '</table>';