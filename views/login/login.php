<?php

@$email = htmlspecialchars($_POST['email']);
@$password = htmlspecialchars($_POST['password']);
@$submit = $_POST['submit'];

$login = new App\Login($email, $password);

if( $_SERVER['REQUEST_METHOD'] === 'POST' ) 
{
    if(isset($submit)) 
    {
        if(empty($login -> getError())){
            $errors = $login -> isValid();
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

        <?php if(!empty($errors['global']))
        {
            ?>
                <p class="error"><?php
                    echo $errors['global'];
                ?></p>
            <?php
        }
        ?>

        <label for="">
            <p class='above'>Email</p>
            <input <?php if(!empty($errors['email'])): ?> style="border: 1px solid coral;" <?php endif ?> type="email" name="email" placeholder="Email" value="<?php if(isset($email)): echo $email; else: echo ""; endif ?>">
        </label>
        <?php if(!empty($errors['email'])) {?>
            <p class="smallError"><?php echo $errors['email'] ?></p>
        <?php } ?>

        <label for="">
            <p class='above'>Password</p>
            <input <?php if(!empty($errors['password'])): ?> style="border: 1px solid coral;" <?php endif ?> type="password" name="password" placeholder="Password">
        </label>
        <?php if(!empty($errors['password'])) {?>
            <p class="smallError"><?php echo $errors['password'] ?></p>
        <?php } ?>

        <button name="submit" type="submit">Submit</button>
    </form>
</div>
