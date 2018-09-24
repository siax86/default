<!Doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Вход</title>
    <link rel="stylesheet" href="/lib/bootstrap/css/bootstrap.css">
  </head>

  <body style="background:#ffffff">
    <div class="container">
      <div class="row justify-content-md-center">
        <div class="col-md-auto">
          <div style = "margin-top: 80px; border-radius: 20px;" class="card">
            <div class="card-body"> 
              <form id="auth-form" action="">
                <div class="form-group">
                  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Введите логин" name="login">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Введите пароль" name="password">
                </div>
                <div class="form-group form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div> 
                <button type="button" class="btn btn-primary auth-btn">ВОЙТИ</button> 
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="/lib/jquery/jquery.js"></script>
    <script src="/lib/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
      function getFormData($form){
        var unindexed_array = $form.serializeArray();
        var indexed_array = {};

        $.map(unindexed_array, function(n, i){
          indexed_array[n['name']] = n['value'];
        });

        return JSON.stringify(indexed_array);
      }


      $('body').on('click','.auth-btn',function() {
        var auth_data = getFormData($('#auth-form'));
        console.log(auth_data);

        $.ajax({
          url: "/api/call.php?client=app&query=auth&data=" + auth_data,
          type: "POST",
          dataType: "json",
          success: function(user){
            if(user.id)
            {
              window.location.href = 'index.php';
            }
            else
            {
              alert('Ошибка авторизации');
            };
            console.log(user);
          }
        });

      });
    </script>
  </body>
</html>