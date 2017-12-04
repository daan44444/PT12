<div class="left flex flex--h-center">
    <form action="" method="post">
        <div class="field margin">
            <label for="regemail" class="absolute">Email</label>
            <input type="email" name="regemail" id="regemail" autocomplete="off" disabled value="EMAIL HERE with escape">
        </div>

        <div class="field margin">
            <label for="regname" class="absolute">Full name (max <?= Config::get('validation/name_max'); ?>)</label>
            <input type="text" name="regname" id="regname" autocomplete="off" maxlength="<?= Config::get('validation/name_max'); ?>" value="<?= escape(Input::get('regname')); ?>">
        </div>

        <div class="field margin">
            <label for="regpassword" class="absolute">Password (min <?= Config::get('validation/password_min'); ?>)</label>
            <input type="password" name="regpassword" id="regpassword" autocomplete="off">
        </div>

        <div class="field margin">
            <label for="regpassword_again" class="absolute">Password again</label>
            <input type="password" name="regpassword_again" id="regpassword_again" autocomplete="off">
        </div>

        <div class="field">
            <label for="regbday" class="absolute">Birth date</label>
            <input type="text" name="regbday" id="regbday" autocomplete="off" class="datepicker">
        </div>

        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        <input type="submit" name="update" value="Update">
    </form>
</div>
