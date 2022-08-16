
var list = [];
$(document).ready(function(){  


    $("#search").keyup(function(event){ 
            $.ajax({
                url: '/post',
                type:  'POST',
                async:  true, 
                data: {
                    search:$("#search").val(),
                },
                success:function(data, status, xhr){

                    list = data;
                    if( !jQuery.isEmptyObject(data)){  
                        const pagi=$('.pagination');
                        pagi.empty();
                        const element=createPagination(data)
                        pagi.append(element)
                        console.log(data['count']);
                        createList( 0 );

                    }
                    else{
                        tbody.append("<tr>\
                            <td>"+"NOT FOUND"+"</td>\
                            <td>"+"NOT FOUND"+"</td>\
                            <td>"+"NOT FOUND"+"</td>\
                            </tr>");
                    }   
                },
                error: function(data, status, xhr){
                    console.log(data.responseText);
                    //alert(data.responseText);
            }
        });
    }); 
 });

 function createList( start ){

    const tbody = $('.table').children('tbody');
    tbody.empty();
    var end = (start +1) * 5;
    for(let i=start; i < end ; i++){
        let edit = "<a title=\"Blah\" href=\"http://localhost:8080/post/edit/" + +list[i]['id'] +
                    "\">Edite<a>";
        let del = "<a title=\"Blah\" href=\"http://localhost:8080/post/delete/" + +list[i]['id'] +
            "\">Delete<a>";
        
        tbody.append("<tr>\
                <td>"+list[i]['title']+"</td>\
                <td>"+list[i]['category']+"</td>\
                <td>"+list[i]['description']+"</td>\
                <td>"+edit+"</td>\
                <td>"+del+"</td>\
                </tr>");
    }
   
 }

 function createPagination(data){
    let elements = [];
    for(let i=0;i<data['page'];i++){
        elements.push(
            `
            <li class="page-item"><a class="page-link pagi" data-number='${i+1}' onclick='fetchArray( ${i} )'>${i+1}</a></li>
            `
        );
    }
    return elements;
}

 function fetchArray( pageNumber){

    createList( (pageNumber * 5) );

 }


 




