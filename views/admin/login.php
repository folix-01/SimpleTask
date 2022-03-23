<?php include ROOT . '/views/layouts/header.php';?>

<body>
<div class="container col-5 mt-5" style="margin-bottom:700px">
    <form method="POST" action="/admin/login">
    <?php if(!empty($errors)):?>
    <?php echo "<small id=\"emailHelp\" class=\"form-text text-danger\">Wrong login data</small>"?>
    <?php endif;?>
    <div class="form-group">
        <label for="exampleInputEmail1">Username</label>
        <input type="username" name="username" class="form-control<?php if(!empty($errors)){echo " is-invalid";}?>" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" name ="password" class="form-control<?php if(!empty($errors)){echo " is-invalid";}?>" id="exampleInputPassword1">
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>

<?php include ROOT . '/views/layouts/footer.php';?>