$(document).ready(function(){ 
    var tmp_name = false;
    var tmp_category = false;
    $('.save').hide();
    $('.dontsave').hide();
    
    $('.categories').on('click','.edit',function(){
        var parents = $(this).parents('li');
        $('.categories .remove').show();
        $('.categories .edit').show();
        $('.categories .save').hide();
        $('.categories .dontsave').hide();
        $('.categories input').addClass('form-control-plaintext');
        $('.categories input').attr('readonly','');
        $('.categories input').removeClass('form-control');
        parents.find('.remove').hide();
        parents.find('.edit').hide();
        parents.find('.save').show();
        parents.find('.dontsave').show();
        tmp_name = parents.find('input[name="name"]').val();
        parents.find('input[name="name"]').removeAttr('readonly');
        parents.find('input[name="name"]').addClass('form-control');
        parents.find('input[name="name"]').removeClass('form-control-plaintext');        
    });
    
    $('.categories').on('click','.dontsave',function(){
        var parents = $(this).parents('li');
        parents.find('.remove').show();
        parents.find('.edit').show();
        parents.find('.save').hide();
        parents.find('.dontsave').hide();
        parents.find('input[name="name"]').val(tmp_name);
        parents.find('input[name="name"]').attr('readonly','');
        parents.find('input[name="name"]').removeClass('form-control');
        parents.find('input[name="name"]').addClass('form-control-plaintext');
    });
    
    $('.categories').on('click','.remove',function(){
        var isAccept = confirm("Вы уверены что хотите удалить категорию ?");
        if(isAccept){
            var idElem = $(this).attr('data-id-elem');
            var elem = $(this);
            $.ajax({
                    type: "POST", 
                    url: '/ajax/remove_category', 
                    data: 'category_id='+idElem, 
                    dataType: "json", 
                    success: function(data) {
                        if(data.success){ 
                            elem.parents('li').addClass('hide');
                        } else { 
                            alert('Произошла ошибка, попробуйте позже');
                        }
                    },
                    error: function(){                         
                        alert('Произошла ошибка, попробуйте позже');
                    }
            });
        }
    });
    $('.notification').on('click','.remove',function(){
        var isAccept = confirm("Вы уверены что хотите удалить уведомление ?");
        if(isAccept){
            var idElem = $(this).attr('data-id-elem');
            var elem = $(this);
            $.ajax({
                    type: "POST", 
                    url: '/ajax/remove_notification', 
                    data: 'notification_id='+idElem, 
                    dataType: "json", 
                    success: function(data) {
                        if(data.success){ 
                            elem.parents('li').addClass('hide');
                        } else { 
                            alert('Произошла ошибка, попробуйте позже');
                        }
                    },
                    error: function(){                         
                        alert('Произошла ошибка, попробуйте позже');
                    }
            });
        }
    });
    $('.add-category').submit(function(){
        var form = $(this);
        var data = $(this).serialize();
        $.ajax({
                type: "POST", 
                url: '/ajax/add_category', 
                data: data, 
                dataType: "json", 
                success: function(data) {
                    if(data.success){ 
                        $( ".categories" ).append('<li class="list-group-item">'+data.data.name+' <i class="fa fa-trash-o remove" data-id-elem="'+data.data.id+'"></i></li>');
                    } else { 
                        alert('Произошла ошибка, попробуйте позже');
                    }
                },
                error: function(){                         
                    alert('Произошла ошибка, попробуйте позже');
                }
        });
        $(this)[0].reset();
        return false;
    });
    $('.add-notification').submit(function(){
        var form = $(this);
        var data = $(this).serialize();
        $.ajax({
                type: "POST", 
                url: '/ajax/add_notification', 
                data: data, 
                dataType: "json", 
                success: function(data) {
                    if(data.success){ 
                        $( ".notification" ).append('<li class="list-group-item">'+data.data.name+' из категории: ('+data.data.category_name+'). Кол-во показов: 0 <i class="fa fa-trash-o remove" data-id-elem="'+data.data.id+'"></i></li>');
                    } else { 
                        alert('Произошла ошибка, попробуйте позже');
                    }
                },
                error: function(){                         
                    alert('Произошла ошибка, попробуйте позже');
                }
        });
        $(this)[0].reset();
        return false;
    });
    
    var showed_ids = ['1'];
    setInterval(function() {
        $.ajax({
                type: "POST", 
                url: '/ajax/show_notification', 
                data: 'showed_ids='+showed_ids, 
                dataType: "json", 
                success: function(data) {                   
                    if(data.success){
                        Notify.generate(data.data.text, data.data.category_name, 0);
                        showed_ids.push(data.data.id)
                    }
                }
        });
    }, 5500);
        
   
});

Notify = {				
    TYPE_INFO: 0,				
    TYPE_SUCCESS: 1,				
    TYPE_WARNING: 2,				
    TYPE_DANGER: 3,								

    generate: function (aText, aOptHeader, aOptType_int) {					
        var lTypeIndexes = [this.TYPE_INFO, this.TYPE_SUCCESS, this.TYPE_WARNING, this.TYPE_DANGER];					
        var ltypes = ['alert-info', 'alert-success', 'alert-warning', 'alert-danger'];										
        var ltype = ltypes[this.TYPE_INFO];					

        if (aOptType_int !== undefined && lTypeIndexes.indexOf(aOptType_int) !== -1) {						
            ltype = ltypes[aOptType_int];					
        }										

        var lText = '';					
        if (aOptHeader) {						
            lText += "<h4>"+aOptHeader+"</h4>";					
        }					
        lText += "<p>"+aText+"</p>";										
        var lNotify_e = $("<div class='alert "+ltype+"'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button>"+lText+"</div>");					

        setTimeout(function () {
            lNotify_e.fadeOut(1000);				
        }, 5000);					
        lNotify_e.appendTo($("#footer"));
        lNotify_e.hide();
        lNotify_e.fadeIn(1000);

    }			
};	