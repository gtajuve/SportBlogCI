<p><?=$this->session->flashdata('errmsg');?></p>
<div id="login">
    <fieldset>
        <legend>Login</legend>
        <?=form_open('login/validate');?>
        <?=form_input('username','Username');?>
        <?=form_password('password','Password');?>
        <?=form_submit('submit','login');?>
        <?=form_close();?>
        <?=validation_errors('<p>');?>
    </fieldset>
</div>