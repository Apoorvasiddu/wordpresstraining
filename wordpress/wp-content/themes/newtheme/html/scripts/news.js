jQuery(document).ready(function(){
    jQuery("#sub-btn").on("click", function (e) {
     e.preventDefault();
     var header = $("#header").val();
     var content=$("#content").val();
     // //alert(name1);
      console.log(header);
      console.log(content);
     if ((header== "") && (content == "")) {
         alert("Please enter your header and content");
         return false;
     }
     if(header==""){
         alert("Please enter header");
         return false;
     }
     if(content==""){
         alert("Please enter content");
         return false;
     }
     else {
         /* Email the administrator */
 
         var data = {
             'action': 'news_form',
             'header': header,
             'content':content,
         };
         var ajaxUrl = 'http://localhost/training/wordpress/wp-admin/admin-ajax.php';
         console.log(ajaxUrl);
         jQuery.post(ajaxUrl, data)
         .done(function (response) {
             if (response == 1) {
                 alert("Sucess");
             } else {
                 alert("fail");
             }
             var data = {
                'action': 'view_form'
            };
            var ajaxUrl = 'http://localhost/training/wordpress/wp-admin/admin-ajax.php';
        //console.log(ajaxUrl);
        jQuery.post(ajaxUrl, data)
        
        .done(function (response) {
            console.log(typeof response);
            var result_div = [];
            result_div = response;
            var array=Array.from(result_div);
            console.log(typeof array);
            //console.log(array);
            // result_div.forEach (myFunction);

            // function myFunction(value, key) {
            //     console.log("hi");
            //     console.log(key + '- ' + value);
            // }
            console.log(result_div);
    })
    .fail(function (response) {
        alert("something went wrong");
    });
    return false;
     })
     .fail(function (response) {
         alert("something went wrong");
     });
     return false;
         }
     });

    //  jQuery("#view-btn").on("click", function (e) {
        
    //     e.preventDefault();
    //     var data = {
    //         'action': 'view_form'
    //     };
    //     var ajaxUrl = 'http://localhost/training/wordpress/wp-admin/admin-ajax.php';
    //     //console.log(ajaxUrl);
    //     jQuery.post(ajaxUrl, data)
        
    //     .done(function (response) {
    //         var result_div = response;
    //         console.log(result_div);
    // })
    // .fail(function (response) {
    //     alert("something went wrong");
    // });
    // return false;
        
    //  });

 });
 