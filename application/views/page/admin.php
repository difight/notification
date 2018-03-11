<div class="links">
    <a href='/logout'>Выход</a>
</div>
<div class="container">
    <h2>Категории уведомлений </h2> 
    <form class="form-inline add-category" method="post">
        <div class="form-group mx-sm-3 mb-2">
          <label for="inputPassword2" class="sr-only">Название категории</label>
          <input type="text" required name='name' autocomplete="none" class="form-control" id="inputPassword2" placeholder="Название">
        </div>
        <button type="submit" class="btn btn-primary mb-2">Добавить категорию</button>
    </form>
    <?php
    if($categories){
        echo '<ul class="list-group list-group-flush categories">';
            foreach($categories as $category){
                echo '<li class="list-group-item"><input required="" name="name" autocomplete="none" class="form-control-plaintext" readonly placeholder="Название" value="'.$category['name'].'" type="text"> <i class="fa fa-check save" data-id-elem="'.$category['id'].'"></i> <i class="fa fa-times dontsave" data-id-elem="'.$category['id'].'"></i> <i class="fa fa-edit edit" data-id-elem="'.$category['id'].'"></i> <i class="fa fa-trash-o remove" data-id-elem="'.$category['id'].'"></i></li>';
            }
        echo '</ul>';
    }
    ?>
    
    <h2>Уведомления</h2> 
    <form class="form-inline add-notification" method="post">
        <div class="form-group mx-sm-3 mb-2">
          <label for="inputPassword2" class="sr-only">Выберите категорию уведомления</label>
          <select required class="form-control" id="exampleFormControlSelect1" name='category_id'>
            <?php
            foreach($categories as $category){
                echo '<option value="'.$category['id'].'">'.$category['name'].'</option>';
            }
            ?>
          </select>
        </div>
        <div class="form-group mx-sm-3 mb-2">
          <label for="inputPassword2" class="sr-only">Текст уведомления</label>
          <input type="text" maxlength='240' required name='name' autocomplete="none" class="form-control" id="inputPassword2" placeholder="Текст уведомления">
        </div>
        <button type="submit" class="btn btn-primary mb-2">Добавить уведомлениe</button>
    </form>
    <?php
    if($categories){
        echo '<ul class="list-group list-group-flush notification">';
            foreach($notification as $notif){
                echo '<li class="list-group-item">'.$notif['text'].' из категории: ('.$notif['category_name'].'). Кол-во показов: '.$notif['viewed'].' <i class="fa fa-check save" data-id-elem="'.$notif['id'].'"></i> <i class="fa fa-times dontsave" data-id-elem="'.$notif['id'].'"></i> <i class="fa fa-edit edit" data-id-elem="'.$notif['id'].'"></i> <i class="fa fa-trash-o remove" data-id-elem="'.$notif['id'].'"></i> </li>';
            }
        echo '</ul>';
    }
    ?>
</div>