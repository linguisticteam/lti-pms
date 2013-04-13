
<br/>
    <div class="row">
        <div class="small-3 panel small-centered columns">
            <?php
                echo form_open('login/process','name="process"');
            ?>        
            <h4 style="text-align: center">Member Login</h4>
            <br />
            <?php
                if(! is_null($msg)) echo $msg;
                echo form_label('Email');
                echo form_input(array('id'=>'email','name'=>'email'),'','autofocus');

                echo form_label('Password');
                echo form_password(array('id'=>'password','name'=>'password'),'');
                
                echo form_submit('submit','Login','class="small button"'); 
                
                echo form_close();
            ?>
        </div>
    </div>
        
        <!--</form>-->
        
<!--        <form action='login/process' method='post' name='process'>
            <h2>User Login</h2>
            <br />
            
            <label for='email'>Email</label>
            <input type='text' name='email' id='username' size='25' /><br />

            <label for='password'>Password</label>
            <input type='password' name='password' id='password' size='25' /><br />

            <input type='Submit' value='Login' />
        </form>-->
    <!--</div>-->