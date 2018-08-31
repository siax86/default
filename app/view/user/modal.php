<div class="modal fade" id="Modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Создать пользователя</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="name">Имя пользователя</label>
            <input type="text" class="form-control" id="name">
          </div>
          <div class="form-group">
            <label for="surname">Фамилия пользователя</label>
            <input type="text" class="form-control" id="surname">
          </div>
          <div class="form-group">
            <label for="middlename">Отчество пользователя</label>
            <input type="text" class="form-control" id="middlename">
          </div>
          <div class="form-group">
            <label for="login">Логин</label>
            <input type="text" class="form-control" id="login">
          </div>
          <div class="form-group">
            <label for="password">Пароль</label>
            <input type="text" class="form-control" id="password">
          </div>
          <div class="form-group">
            <label for="user_status">Статус пользователя</label>
            <input type="text" class="form-control" id="user_status">
          </div>
          <div class="form-group">
            <label for="delmark">delmark</label>
            <input type="text" class="form-control" id="delmark">
          </div>
          <!-- идентификатор -->
          <input type="hidden" name="id" id="id">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
        <button type="button" class="btn btn-primary">Сохранить</button>
      </div>
    </div>
  </div>
</div>