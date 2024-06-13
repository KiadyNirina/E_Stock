<?php

@$email = htmlspecialchars($_POST['email']);
@$password = htmlspecialchars($_POST['password']);
@$submit = $_POST['submit'];

$login = new App\Login($email, $password);

if( $_SERVER['REQUEST_METHOD'] === 'POST' ) 
{
    if(isset($submit)) 
    {
        if($login -> isValid()){

        } else {
            $errors = $login -> getError();
        }
    }
}

?>

<div class="authContainer">
    <form action="" method="POST">
        <h1>Login</h1>
        <p id="nb">Nb: Seul l'administrateur peut se connecter</p>

        <?php if($errors)
        {
        ?>
            <p class="error"><?php
                echo $errors -> $error['global'];
            ?></p>
        <?php
        }
        ?>

        <label for="">
            <p class='above'>Email</p>
            <input type="email" name="email" placeholder="Email">
        </label>
        <?php if(isset($error['email'])) {?>
            <p class="error"><?php echo $error['email'] ?></p>
        <?php } ?>

        <label for="">
            <p class='above'>Password</p>
            <input type="password" name="password" placeholder="Password">
        </label>

        <button name="submit" type="submit">Submit</button>
    </form>
</div>
