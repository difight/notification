<form class="form-signin" action="/login" method="post">
    <div class="text-center mb-4">
      <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Авторизация</h1>
    </div>
    <?php if ($error) {?>
        <div class="alert alert-danger">
            <strong>Ошибка!</strong> Не верно введены логин или пароль.
        </div>
    <?php }?>
    <div class="form-label-group">
      <input id="inputEmail" class="form-control" placeholder="Username" required="" autofocus="" name="username" type="text">
    </div>

    <div class="form-label-group">
      <input id="inputPassword" class="form-control" placeholder="Password" required="" name="password" type="password">
    </div>
    
    <button class="btn btn-lg btn-primary btn-block" type="submit">Вход</button>
</form>