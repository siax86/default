      /**/
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

      /*Функция загрузки нужной view (параметры: куда, откуда, что)*/
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
            //console.log(id);

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
                //console.log(test);
                $(_element).append(test);

              })
            }

            /*действия при создании*/
            else
            {
              $.each(result, function(row,obj){
                var test = '<option value="'+obj.id+'">'+obj.name+'</option>';
                //console.log(test);
                $(_element).append(test);
              })
            };
          }
        });

      }




      /*загрузка контента в боковую панель(second-navbar) в зависимости от того пользователя, под которым зашли в систему*/
      $(document).ready(function() {
        //console.log('flfl');
        $.ajax({
          /*тот пользователь, под которым зашли*/
          url: '/api/call.php?client=app&query=get&data={"class":"user","data":{"id":"current"}}',
          type: "POST",
          dataType: "json",
          success: function(result){
            user = result;
            console.log(user);
            //console.log(user.config);

            /*функция user.loadComponent - добавляет все компоненты во вьюшку second-navbar*/
            user.loadComponent = function(){
              /*пройтись в цикле each по каждому компоненту*/
              $.each(this.config.components,function(component,property){
                //console.log(component);
                //console.log(property);
                var navbar_link = '<li class="nav-item"><a data-component="' + component + '" class="nav-link component-link" href="#">' + property.name  + '</a></li>';
                $('.second-navbar-links').append(navbar_link);
              });
            };

            /*загружает эту вьюшку в нужно место*/
            loadView('#second-navbar','global','second-navbar',function() {
              user.loadComponent();
            });
            /*загружает контент на главной странице админки*/
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


      /*действия при клике на класс loadmodal (создание и редактирование строк в таблице)*/
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
                //console.log(name);  
                selectConstructor('#' + name, name);
              });
            $('#Modal').modal('show');
          });
          break;

          case 'update':
          loadView('#modalbox',obj,'modal',function(){
            /*в data не содержится инфы про group*/
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
                    //console.log(key);
                    selectConstructor('#' + key, key, val);
                  }
                  else
                  {
                    $('#' + key).val(val);
                  };
                };
              });

            $('#Modal').find('[registr]').each(function(){
              var name = $(this).attr('name');
              $.ajax({
                url: '/api/call.php?client=app&query=get&data={"class":"' + name + '"}',
                type: "POST",
                dataType: "json",
                success: function(result){
                  var val_registr = $('#'+name).attr('registr');
                  $.ajax({
                    url: 'api/call.php?client=app&query=get&data={"class":"registr","data":{"name":"'+val_registr+'","user":"'+data['DT_RowId']+'"}}',
                    type: "POST",
                    dataType: "json",
                    success: function(result1){
                      $.each(result, function(row,obj){
                        var test = '<option value="'+obj.id+'">'+obj.name+'</option>';
                        $('#'+name).append(test);
                      })
                      $.each(result, function(row,obj){
                        $.each(result1, function(row1,obj1){
                          if (obj.id==obj1.id)
                          {
                            $('#'+name).find('option[value='+obj.id+']').prop('selected',true);
                          }
                        })
                      })
                    } 
                  })
                }
              });
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
        var data_registr = [];
        var value_attr_registr;
        $(msg).each(function(index, obj){
          value_attr_registr=$('#'+obj.name).attr('registr');
          if (value_attr_registr && (obj.name!=msg[index-1].name))
          { 
            var value_registr={};
            var id_registr=[];
            $(msg).each(function(index2, obj2){
              if(obj.name==obj2.name) 
              {
                id_registr.push(Number(obj2.value));
              }
            })
            value_registr['name']=value_attr_registr;
            value_registr[obj.name]=id_registr;
            data_registr.push(value_registr);
          } 
          if (!value_attr_registr) 
          {
            data[obj.name] = obj.value;
          }
        });
        data['registr']=data_registr;
        console.log('/api/call.php?client=app&query=set&data={"class":"user","data":'+JSON.stringify(data)+'}');
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
