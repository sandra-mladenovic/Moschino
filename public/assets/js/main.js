$(document).ready(function () {
    $(document).on('click','#btnComment',function(e){
        e.preventDefault();
        if($('#usercomment').val()){
            document.getElementById("text-error").innerHTML="";
            addCommentAjax();
        }else{
            document.getElementById("text-error").innerHTML="Comment is required";
        }

    });

    //click actions
    $(document).on('click','#btnDeletePost',deletePost);
    $(document).on('click','.btnAdminDelete',deletePostAdmin);
    $(document).on('click','.btnAdminDeleteUser',deleteUserAdmin);
    $(document).on('click','.btnAdminDeleteCat',deleteCategoryAdmin);
    $(document).on('click','.btnAdminDeleteCom',deleteComAdmin);

    $('#date').on('change', getDate);
    $(document).on('keyup','#searchPost',searchPost);
    $(document).on('click','.btnAdminDeleteMess',deleteMessAdmin);
})
let urlParams = new URLSearchParams(window.location.search);
let search_query = urlParams.get('query');

//search posts
function searchPost(){
    if (event.keyCode === 13) {
        let search_query=$("#searchPost").val();
        let link=baseUrl+"/results?query="+search_query
        window.location.href=link;
    }
}

//pagination
$(document).on('click','.pagination a',function(e){
    e.preventDefault();
    var url=$(this).attr('href');
    console.log(url);
    $.ajax({
        url:url,
        method:"get",
        dataType:"json",
        data:{search:search_query},
        success:function(data){
            if(data.status=="ok"){
                $("#postovi").html(data.posts);
            }
            if(data.status=='search'){
                var pod=data['posts'].data;
                var pag=data['pagination'];
                showSearchedPosts(pod,pag);
            }
        },error:function(error){
            console.log(error);
        }
    });
    return false;
});



//filtering user activities on admin panel
function ajaxFilterdActivitiesShow(data){
    let br=1;
    let show=``;
    for(let d of data){
        show+=`
          <tr>
            <td>${br++}</td>
            <td>${d.full_name}</td>
            <td>${d.action}</td>
            <td>${formatDatum(d.date)}</td>
         </tr>
        `
    }

    $('#action').html(show);
}
function getDate(){
    var date = document.getElementById("date").value;
    $.ajax({
        url:baseUrl+"/api/admin",
        method:"get",
        data:{date:date},
        success:function(data){
            ajaxFilterdActivitiesShow(data);

        },error:function(error){
            console.log(error);
        }
    });


}
// end filtering user activities on admin panel

//post comments
function addCommentAjax(){
    var id=document.getElementById("id_post").value;
    $.ajax({
        url:baseUrl+"/api/comment",
        method:"POST",
        data:{
            post_id:document.getElementById("id_post").value,
            id_user:document.getElementById('id_user').value,
            comment:document.getElementById("usercomment").value
        },success:function(data){
            getComments(id);
        },error:function(xhr,error){
            console.log(xhr);
        }

    })
}

function getComments(id){
    $.ajax({
        url:baseUrl+"/api/comments/"+id,
        method:"get",
        success:function(data){
            showComments(data);
        },error:function(error){
            console.log(error);
        }
    })
}

function showComments(data){
    let ispis="";
    for(let d of data){
        ispis+=`
        <div class="comment">
        <div class="comment-header d-flex justify-content-between">
            <div class="user d-flex align-items-center">
            <div class="title"><strong>${d.full_name}</strong><span class="date">${formatDate(d.date)}</span></div>
            </div>
        </div>
        <div class="comment-body">
            <p>${d.comment}</p>
        </div>
        </div>
        `
    }
    function formatDate(date){
        var datum=new Date(date);
        var months=["January","February","March","May","Jun","July","August","September","November","December"];
        var month=months[datum.getMonth()];
        var year=datum.getFullYear();
        var datumm=month+" "+year;
        return datumm;
    }
    document.getElementById("allComments").innerHTML=ispis;
    $("#usercomment").val('');

}
//end post comments

function showSearchedPosts(data,pag){
    let show=``;
    for(let d of data){
        show+=`
        <div class="post col-lg-6">
        <div class="post-thumbnail">
            <a href="`+baseUrl+`/posts/${d.id_post}"><img src='`+baseUrl+`/assets/images/${d.photo}' alt="..." class="img-fluid"></a>
        </div>
        <div class="post-details">
          <div class="post-meta d-flex justify-content-between">
          </div><a href="`+baseUrl+`/posts/${d.id_post}">
            <h3 class="h4">${d.title}</h3></a>
            <p class="text-muted postDesc">${d.description}</p>
          <footer class="post-footer d-flex align-items-center"><a href="`+baseUrl+`/user_posts/${d.id_user}" class="author d-flex align-items-center flex-wrap">
              <div class="">${d.full_name}</div>
              <div class="title"><span></span></div></a>
            <div class="date"><i class="icon-clock"></i>${formData3(d.created_at)}</div>
            <div class="views"><i class="icon-eye"></i>${d.view}</div>
          </footer>
        </div>
      </div>
        `
    }
    show+=pag;
    $('#postovi').html(show);


}

//delete post user
function deletePost(){
    var id=$(this).data('id');
    $('#deleteModal').modal('show');
    var forma=document.getElementById('deleteForma');
   forma.action=baseUrl+'/user_posts/'+id
}

//admin crud operations
function deletePostAdmin(){
    var id=$(this).data('id');
    $('#deleteModalAdmin').modal('show');
    var forma=document.getElementById('deleteFormaAdmin');
    forma.action=baseUrll+'/posts/'+id

}

function deleteUserAdmin(){
    var id=$(this).data('id');
    $('#deleteModalAdminUser').modal('show');
    var forma=document.getElementById('deleteFormaAdminUser');
    forma.action=baseUrll+'/users/'+id

}

function deleteCategoryAdmin(){
    var id=$(this).data('id');
    $('#deleteModalAdminCat').modal('show');
    var forma=document.getElementById('deleteFormaAdminCat');
    forma.action=baseUrll+'/category/'+id
}

function deleteComAdmin(){
    var id_comment=$(this).data('id');
    deleteCommAjax(id_comment);
}

function deleteCommAjax(id_comment){

    $.ajax({
        url:baseUrl+"/api/comment/"+id_comment,
        method:"DELETE",
        success:function(data){
            ajaxGetComm();

        },error:function(error){
            console.log(error);
        }
    });
}

function deleteMessAdmin(){
    var id_mess=$(this).data('id');
    deleteMessAjax(id_mess);
}

function deleteMessAjax(id_mess){

    $.ajax({
        url:baseUrl+"/api/contact/"+id_mess,
        method:"DELETE",
        success:function(data){
            ajaxGetMess();

        },error:function(error){
            console.log(error);
        }
    });
}

function ajaxGetMess(){
    $.ajax({
        url: baseUrl+"/api/contact",
        method: "GET",
        success: function(data){
            console.log(data);
            showAllMess(data);
        },error:function(error){
            console.log(error);
        }
    })
}

function showAllMess(data){
    let br=1;
    let show=``;
    for(let d of data){
        show+=`
          <tr>
            <td>${br++}</td>
            <td>${d.email}</td>
            <td>${d.subject}</td>
            <td>${formatDatum(d.date)}</td>
               <td class="td-actions">
               <a href="`+baseUrll+`/messages/${d.id_message}">
                    <button class="btn btn-info"> Read</button>
                </a>
                 <button class="btn btn-danger btn-fab btn-fab-mini btnbtnAdminDeleteMess" data-id="${d.id_message}">
                      <i class="material-icons">close</i>
                  </button>
                 </td>
            </tr>
        `
    }

    $('#com').html(show);

}

function ajaxGetComm(){
    $.ajax({
        url: baseUrl+"/api/comment",
        method: "GET",
        success: function(data){
            showAllComm(data);
        },error:function(error){
            console.log(error);
        }
    })
}

function showAllComm(data){
    let br=1;
    let show=``;
    for(let d of data){
        show+=`
          <tr>
            <td>${br++}</td>
            <td>${d.full_name}</td>
            <td>${d.title}</td>
            <td>${d.comment}</td>
            <td>${formatDatum(d.date)}</td>
               <td class="td-actions">
                 <button class="btn btn-danger btn-fab btn-fab-mini btn-round btnAdminDeleteCom " data-id=${d.id_comment}>
                      <i class="material-icons">close</i>
                  </button>
                 </td>
            </tr>
        `
    }

    $('#com').html(show);

}

//date formats
function formatDatum(date){
    var datum=new Date(date);
    var dan=datum.getDate();
    var month=datum.getMonth() + 1;
    var year=datum.getFullYear();
    var datumFormat=dan+"."+month+"."+year+".";
    return datumFormat;
}

function formData3(date){
    var datum=new Date(date);
    var months=["January","February","March","May","Jun","July","August","September","November","December"];
    var day=datum.getDate();
    var month=months[datum.getMonth()];
    var year=datum.getFullYear();
    var d=month+" "+day+", "+year;
    return d;
}

