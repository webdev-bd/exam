<section class="homepage-bg">    
    <div class="login">
        <?php $attributes = array('id' => 'login_form');echo form_open('administrator/signin', $attributes); ?>    
             <input type="text" class="form-control" id="username" placeholder="Username" required="required" name="id">
            <input type="password" class="form-control" id="password" placeholder="Password" required="required" name="password">
            <input type="submit" class="btn label-danger" value="Login">
        </form>
        
    </div>
</section>
