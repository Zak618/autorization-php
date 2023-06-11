<?php
    require "db.php";

    $data = $_POST;
    if (isset($data['do_signup'])){
        // Registration


        $errors = array();
        if ( trim($data['login']) == '' ) {
            $errors[] = 'Введите логин!';
        }

        if ( trim($data['email']) == '' ) {
            $errors[] = 'Введите Email!';
        }

        if ( $data['password'] == '' ) {
            $errors[] = 'Введите пароль!';
        }
        
        if ( $data['password2'] != $data['password'] ) {
            $errors[] = 'Неверный пароль!';
        }

        if ( R::count('users', "login = ? OR email = ?", array($data['login'], $data['email'])) > 0 ) {
            $errors[] = 'Такой пользователь уже существует!';
        }

        if ( empty($errors) ){
            $user = R::dispense('users');
            $user->login = $data['login'];
            $user->email = $data['email'];
            $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
            R::store($user);
            echo '<div style="color: green;">Вы успешно зарегистрированы</div><hr>';
        } else {
            echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
        }

    }
?>

<form action="signup.php" method="POST">
    <p>
        <p><strong>Ваш логин</strong></p>
        <input type="text" name="login" value="<?php echo @$data['login'];?>">
    </p>

    <p>
        <p><strong>Ваш Email</strong></p>
        <input type="email" name="email" value="<?php echo @$data['email'];?>">
    </p>

    <p>
        <p><strong>Ваш пароль</strong></p>
        <input type="password" name="password">
    </p>

    <p>
        <p><strong>Повторите пароль</strong></p>
        <input type="password" name="password2">
    </p>

    <p>
        <button type="submit" name="do_signup">Зарегистрироваться</button>
    </p>
</form>