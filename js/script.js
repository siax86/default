      function getColumnIndexesWithClass( columns, className ) {
        var indexes = [];
        $.each( columns, function( index, columnInfo ) {
          if( columnInfo.className == className ) {
            indexes.push( index );
          }
        });

        return indexes;
      };

      /*создание объекта user*/
      user = new Object();

      /*Функция загрузки нужной view*/
      function loadView(place,obj,view,calback = false)
      {
        $(place).empty();
        $(place).load('/app/view/' + obj + '/' + view + '.php',calback);
      }

      //selectConstructor('#user_status','user_status')

      /*функция загрузки данных с сервера в тег select*/
      function selectConstructor(_element, _class, id = false)
      {
        $.ajax({
          url: '/api/call.php?client=app&query=get&data={"class":"' + _class + '"}',
          type: "POST",
          dataType: "json",
          success: function(result){
            //console.log(result);

            /*действия при редактировании*/
            if (id)
            {
              $.each(result, function(row,obj){
                if (id==obj.id)
                {
                  var test = '<option value="'+obj.id+'" selected>'+obj.name+'</option>';
                }
                else
                {
                  var test = '<option value="'+obj.id+'">'+obj.name+'</option>';
                };

                $(_element).append(test);

              })
            }

            /*действия при создании*/
            else
            {
              $.each(result, function(row,obj){
                var test = '<option value="'+obj.id+'">'+obj.name+'</option>';
                console.log(test);
                $(_element).append(test);
              })
            };

          }
        });

      }

      /*загрузка контента в боковую панель(second-navbar)*/
      $(document).ready(function() {
        $.ajax({
          url: '/api/call.php?client=app&query=get&data={"class":"user","data":{"id":"current"}}',
          type: "POST",
          dataType: "json",
          success: function(result){
            user = result;
            //console.log(user);
            user.loadComponent = function(){
              $.each(this.config.components,function(component,property){
                console.log(component);
                console.log(property);
                var navbar_link = '<li class="nav-item"><a data-component="' + component + '" class="nav-link component-link" href="#">' + property.name  + '</a></li>';
                $('.second-navbar-links').append(navbar_link);
              });
            };

            loadView('#second-navbar','global','second-navbar',function() {
              user.loadComponent();
            });
            loadView('#content','global','homepage');
          }
        });
      })

      $('body').on('click','.component-link',function() {
        var component = $(this).data('component');
        loadView('#content',component,'list',function(){
          console.log(component + ' load!');
        });
      });

      $('body').on('click','.loadmodal',function() {
        var obj = $(this).data('obj');
        var query = $(this).data('query');
        var data = $(this).data('data');
        //console.log(data);

        switch (query) {
          case 'create':
          loadView('#modalbox',obj,'modal',function(){
            //find select in modal, get name and selectConstruct
            $('#Modal').find('select').each(function(){
              var name = $(this).attr('name');
              selectConstructor('#' + name, name);
            });
            $('#Modal').modal('show');
          });
          
          break;

          case 'update':
          loadView('#modalbox',obj,'modal',function(){
            $.each(data,function(key,val){
              if(key == 'DT_RowId')
              {
                $('#id').val(val);
              }
              else
              {
                  //if current element by id is select -> selectConst with id
                  if($('#' + key).is('select'))
                  {
                    selectConstructor('#' + key, key, val);
                  }
                  else
                  {
                    $('#' + key).val(val);
                  };
                };
              });
            $('#Modal').modal('show');
          });

          break;
        };

        
      });
      
      /*добавление и обновление данных в таблице*/
      $('body').on('click','.save',function() {         /*действия при нажатии кнопки "Сохранить"*/
        /*собрать данные с формы и прислать их на сервер с помощью аякс-запроса*/
        var msg = $('#formx').serializeArray();
        var data = {};
        $(msg).each(function(index, obj){
          data[obj.name] = obj.value;
        });

        $.ajax({
          url: '/api/call.php?client=app&query=set&data={"class":"user","data":'+JSON.stringify(data)+'}',
          type: "POST",

          /*действия при ответе сервера в случае успеха*/
          success: function(){
            $("#modalbox .close").click();             /*закрыть модальное окно*/
            var table = $('#datatable').DataTable();   /*перерисовать таблицу*/
            table
            .clear()
            .draw();
          },

          /*действия при ответе сервера в случае ошибки*/
          error:  function(){
            alert('Возникла ошибка');
          }

        });
      });
