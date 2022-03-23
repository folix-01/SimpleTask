<?php include ROOT . '/views/layouts/header.php';?>
<body>
    <div class="container" style="margin-top:10px;">
        <div class="row d-flex justify-content-end">
            <a class="btn btn-warning" href="<?php ($_SERVER['REQUEST_URI'] . $page);?>?reverse=<?php
            if(!$reverseSort){
                echo "true";
            } else {
                echo "false";
            }
            
            ?>">Reverse sort</a>
            <a class="btn btn-info" href="<?php ($_SERVER['REQUEST_URI'] . $page);?>?sort=id">Id sort</a>
            <a class="btn btn-info" href="<?php ($_SERVER['REQUEST_URI'] . $page);?>?sort=email">email sort</a>
            <a class="btn btn-info" href="<?php ($_SERVER['REQUEST_URI'] . $page);?>?sort=username">username sort</a>
        <div>
    </div>
    <div class="container">
        <?php foreach($taskList as $task): ?>
            <div class="card task" style="margin-top:20px">
                <p hidden><?php echo $task['id']?></p>
                <div class="card-header">
                    <?php echo $task['username']; ?> (<?php echo $task['email']; ?>)
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $task['date'] ?></h5>
                    <p class="card-text"><?php echo $task['text']?></p>
                    <?php if($task['done']){echo '<p style="color:green;">Done</p>';}
                          else {echo '<p style="color:Blue;">Processing</p>';}
                    ?>
                </div>
            </div>
        <?php endforeach;?>
        <div class="container">
             <?php echo $pagination->get();?>
        </div>
        <form method="POST" action="" style="margin-top:100px;border:1px solid grey;border-radius:20px;padding:40px">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="username" name="username" class="form-control<?php if(!empty($formValidationErrors['username'])){echo " is-invalid";}?>" id="username">
                <?php if(!empty($formValidationErrors) && $formValidationErrors['username'] == 'empty'):?>
                <?php echo "<small id=\"emailHelp\" class=\"form-text text-danger\">Username cant be empty!</small>"?>
                <?php endif;?>
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" name="email" class="form-control<?php if(!empty($formValidationErrors['email'])){echo " is-invalid";}?>" id="email" aria-describedby="emailHelp">
                <?php if(!(!empty($formValidationErrors) && $formValidationErrors['email'] == 'empty')):?>
                <?php echo "<small id=\"emailHelp\" class=\"form-text text-muted\">We'll never share your email with anyone else.</small>";?>
                <?php else:?>
                <?php echo "<small id=\"emailHelp\" class=\"form-text text-danger\">Email cant be empty!</small>"?>
                <?php endif;?>
                
            </div>
            <div class="form-group">
                <label for="text">Task text</label>
                <input name="text" type="text" class="form-control <?php if(!empty($formValidationErrors['text'])){echo " is-invalid";}?>" id="text" aria-describedby="text">
                <?php if(!empty($formValidationErrors) && $formValidationErrors['text'] == 'empty'):?>
                <?php echo "<small id=\"emailHelp\" class=\"form-text text-danger\">Task text cant be empty!</small>"?>
                <?php endif;?>
            </div>
            <button type="submit" name="submit" class="btn btn-info">Submit</button>
        </form>
        </div>
</body>
<?php include ROOT . '/views/layouts/footer.php';?>