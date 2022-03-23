var checkboxesList = $(".done-check");

for(var i = 0; i < checkboxesList.length; i++){
    checkboxesList[i].onclick = function(){
        var id = this.parentNode.childNodes[1].innerHTML;
        if(this.checked == true){
            var done = 1;
        } else {
            var done = 0;
        }
     
        console.log(done);
        $.ajax({
            url: ("/admin/setstatus/" + id +"/" + done),
            context: document.body
        }).done(function() {
            console.log("set " + done);
        });
        
    }
}

