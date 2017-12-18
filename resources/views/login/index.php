            <div class="left flex flex--h-center">
                <form action="" method="post">
                    <div class="field">
                        <label for="email" class="absolute">Email</label>
                        <input type="email" name="email" id="email" autocomplete="off">
                    </div>

                    <div class="field">
                        <label for="password" class="absolute">Password</label>
                        <input type="password" name="password" id="password" autocomplete="off">
                    </div>

                    <div class="field">
                        <label for="remember" class="container flex flex--v-center">
                            <input type="checkbox" name="remember" id="remember">Remember me
                            <span class="checkmark"></span>
                        </label>
                    </div>

                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                    <div class="wrap flex">
                        <input type="submit" name="login" value="Log in">
                        <input type="submit" name="register" value="Register">
                    </div>
                    <a href="user/forgot" class="forgot">Forgot password</a>

                    <?php
                    $errors = $data['errors'];
                    if($errors) {
                        $passed = $data['registerPassed'] == true ? "green": "";
                        echo "<div class=\"errors {$passed}\"><ul>";
                        foreach ($errors as $error) {
                            echo "<li>{$error}</li>";
                        }
                        echo "</ul></div>";
                    }
                    ?>
                </form>
            </div>
