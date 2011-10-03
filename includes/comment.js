$(function (){ 
  	
      /* Объект sendDataComment будет содержать данные для отправки на сервер
         commentForm - переменная, в которую будет помещен клон формы         */

      var sendDataComment = {}; 
      var commentForm; 
// Функция создает форму для ответа путем клонирования нашей спрятанной формы
      function CommentForm()
      {
      	if(commentForm) 
	{
          // Проверяем существования клона. Если он уже создан, то удаляем его, а затем создаем новый. 
            removeCommentForm();  
          } 
          commentForm = $('#newComment').clone();
      }
      
      // Функция удаления клона 
      function removeCommentForm()
      {
         commentForm.remove();
         sendDataComment = {};
      }
      
      
      /* На событие клика по кнопке "Добавить комментарий/Ответить" вешаем необходимые действия */
      
$('#addNewComment, .reply').click(function(){
          
          CommentForm(); // Создаем клона формы
          
          if($(this).attr('id') == 'addNewComment')
          {
              // Новый комментарий
              // Добавляем форму после всех комментариев
            commentForm.appendTo('#commentRoot');
             
          }
          else
          {
              // Новый ответ
              // Добавляем форму под родительским комментарием 
              // Для этого находим родительский элемент li
              var parentComment = $(this).parent().parent();
             
              // в sendDataComment добавим идентификатор родителя
              sendDataComment.parent_id = parentComment.attr('id');
              sendDataComment.text_id = $("body").attr("text_id");
             
             var childs =  parentComment.find('ul'); // Ищем у этого коммента потомков (ответы)
             
             if(!childs.length) 
             {
              // Если у этого комментария нет  ответов (потомков) добавим для ответов контейнер ul, а затем уже в этот контейнер нашу форму
                 parentComment.append('<ul></ul>');
                 commentForm.appendTo(parentComment.children('ul'));
             }  
             else
              commentForm.prependTo(childs); // Добавляем форму в контейнер для ответов
              
          }
          
          commentForm.show(); // Показываем форму
          
          return false; // предотвращаем дефолтное действие браузера
      });
      
      
     
      $('#cancelComment').live('click', function(){
          // Здесь live обязательно, т.к. мы работаем не с самой формой, а ее клоном 
          removeCommentForm();
  
      })
 
      
 /* По клику на кнопку "Сохранить", доформировываем объект данных и отправляем их на сервер */

 $('#newComment button').live('click',function(){
    sendDataComment.author = commentForm.find("input[name='name']").val(); 
    // Подробнее о поиске элементов по аттрибутам тут http://ruseller.com/lessons.php?rub=32&id=682  
    sendDataComment.comment = commentForm.find("textarea").val();
	sendDataComment.text_id = $("body").attr("text_id");
    sendData(); // Отправка данных
    
 });

 // Функция отправки данных комментария на сервер

function sendData()
{
   commentForm.find('button').hide().next().show(); // Прячем кнопку и показываем лоадер

  $.post(
           "includes/savecomment.php",
           sendDataComment, 
           function(data){ // Обработчик ответа от сервера
            
            
            if(data)
            {   
                // Если что-то пришло, значит есть ошибки
                data = $.parseJSON(data); // Преобразовываем пришедшую строку JSON в объект JS 
                
	// Теперь в цикле пройдемся по всем ошибкам

                var errors =''; 
                $.each(data, function(i, val) {
                errors += val+'\n';
                  
	  // alert(i); 
                  /* В i на каждой итерации цикла содержится имя поля, 
		в котором возникла ошибка, расскоментируйте alert() выше
                   и отправьте комментарий, заведомо содержащий ошибку.
                   Подумайте, как это можно использовать. */
                  
                });
                
                
                commentForm.find('button').show().next().hide(); // показываем кнопку и прячем лоадер                    
                alert(errors); 
	
	/* Выведем ошибки простым alert-ом.
                 Но по-хорошему, конечно же, такие сообщения лучше встроить 
	на страницу, под тем полем, где возникла ошибка. */
                             
            }
           else // Если ошибок нет, значит у нас все нормально сохранилось 
               formToComment(); // Форму комментария преобразуем в просто коммент               
          }
)
}

 
 // Функция преобразование формы в комментарий

 function formToComment()
 {
   commentForm.find('h6').text(sendDataComment.author); // Заменяем содержимое h6 на имя комментатора (инпут таким образом сам удалится)
   commentForm.find('.comment').text(sendDataComment.comment); // Заменяем содержимое блока div с классом .comment только на текст (текстарея удалится сама)
   
// Удаляем теперь уже лишние элементы
   commentForm.find('button').remove();  // Удаляем кнопку
   commentForm.find('.loader').remove(); // Удаляем картинку-лоадер
   commentForm.find('#cancelComment').remove(); // Удаляем кнопку закрытия формы
   /* Обязательно Удаляем атрибут id у клона.
      На данный момент он у объекта commentForm такой же, что и у спрятанной базовой формы,
      а это значит: во-первых, двух элементов с одинаковым id быть не должно, 
      во-вторых, оставлять id никак нельзя, иначе в дальнейшем, при попытке создания нового клона, клонироваться будет этот комментарий, а не нужная нам форма
   */
   commentForm.removeAttr('id');
   commentForm = null; 
   // Обязательно commentForm присваиваем значение null, таким образом, мы разорвем связь между полученным в итоге комментом и объектом в js 
 }
     
    
  });    
