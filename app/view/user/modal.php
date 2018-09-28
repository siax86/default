<div class="modal fade" id="Modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h5 class="modal-title" id="exampleModalLabel">Создать пользователя</h5> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formx">
          <!-- идентификатор -->
          <input type="hidden" name="id" id="id">
          <div class="form-group">
            <label for="name">Имя пользователя</label>
            <input name="name" type="text" class="form-control" id="name">
          </div>
          <div class="form-group">
            <label for="surname">Фамилия пользователя</label>
            <input name="surname" type="text" class="form-control" id="surname">
          </div>
          <div class="form-group">
            <label for="middlename">Отчество пользователя</label>
            <input name="middlename" type="text" class="form-control" id="middlename">
          </div>
          <div class="form-group">
            <label for="login">Логин</label>
            <input name="login" type="text" class="form-control" id="login">
          </div>
          <div class="form-group">
            <label for="password">Пароль</label>
            <input name="password" type="text" class="form-control" id="password">
          </div>
          <div class="form-group">
            <label for="user_status">Статус пользователя</label>
            <select name="user_status" class="form-control" id="user_status"></select>
          </div>
          <div class="form-group">
            <label for="config">Config</label>
            <select name="config" class="form-control" id="config"></select>
          </div>
          <div class="form-group">
            <label for="role">Роль</label>
            <select name="role" class="form-control" id="role"></select>
          </div>

          <div class="form-group">
            <label for="group">Группа</label>
            <select name="group" class="mdb-select md-form form-control" id="group" registr="registr_user_group" multiple></select>
            <!--<button class="btn-save btn btn-primary btn-sm">Save</button>-->
          </div>

          <div class="form-group">
            <label for="delmark">delmark</label>
            <input name="delmark" type="text" class="form-control" id="delmark">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
        <button type="button" class="save btn btn-primary">Сохранить</button>
      </div>
    </div>
  </div>
</div>