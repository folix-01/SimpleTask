<?php include ROOT . '/views/layouts/admin_header.php';
?>
<body>
  <div class="container">
    <?php foreach ($taskList as $task): ?>
        <form action="/admin/update" method="POST" style="border:1px solid black;border-radius:20px;padding:50px;margin-top:50px">
        <p hidden id="id"><?php echo $task['id'];?></p>
        <div class="form-group">
            <label for="exampleFormControlInput1">Username</label>
            <input type="username" name="username" class="form-control" id="exampleFormControlInput1" value="<?php echo $task['username'];?>">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleFormControlInput1" value="<?php echo $task['email'];?>">
        </div>    
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Text</label>
            <textarea class="form-control" name="text" id="exampleFormControlTextarea1" rows="3"><?php echo $task['text'];?></textarea>
        </div>
        <input class="task-identifier" name="id" hidden value="<?php echo $task['id']?>">
        <label for="exampleFormControlTextarea1">Done</label>
        <input class="done-check" name="status" type="checkbox" <?php if($task['done'] == 1){ echo "checked";}?> aria-label="Done"><br><br>
        <button type="submit" name="submit" class="btn btn-primary">Save</button>
        <a class="btn btn-danger" href="/admin/delete/<?php echo $task['id']?>">Delete</a>
        </form>
    <?php endforeach; ?>
    </div>
</body>
<?php include ROOT . '/views/layouts/footer.php';?>