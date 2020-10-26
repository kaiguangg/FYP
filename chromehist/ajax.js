
function storeUrl() {
    var ul = document.getElementById("historyUL");
    var items = ul.getElementsByTagName("li");
    var itemstosave = [];
    for(var i = 0; i < items.length; i++){
      itemstosave.push(ul.getElementsByTagName("li")[i].innerHTML);
    }
      $.ajax({
        type: 'post',
        url: 'https://protectmypassword.xyz:443/Controllers/Generate_Password/pwset.php',
        data:{
          urltosave:JSON.stringify(itemstosave)
        },
        success: function(response)
        {
          document.getElementById("autopw").innerHTML = "Successful";
        }
      });
}

storeUrl();