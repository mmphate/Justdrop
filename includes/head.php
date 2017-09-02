<head>
    <meta charset="UTF-8">
    <title>JustDrop</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"/>  -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- jQuery & JS files -->
    <script src="js/jquery-2.2.3.min.js"></script>
    <script src="js/jquery.cycle.all.js"></script>
    <script src="js/slider.js"></script>



        <!--  <script src="js/script.js"></script> -->
    <link rel="stylesheet" href="themes/base/jquery.ui.all.css">
    
    <script src="ui/jquery.ui.core.js"></script>
    <script src="ui/jquery.ui.widget.js"></script>
    <script src="ui/jquery.ui.mouse.js"></script>
    <script src="ui/jquery.ui.button.js"></script>
    <script src="ui/jquery.ui.draggable.js"></script>
    <script src="ui/jquery.ui.position.js"></script>
    <script src="ui/jquery.ui.resizable.js"></script>
    <script src="ui/jquery.ui.button.js"></script>
    <script src="ui/jquery.ui.dialog.js"></script>
    <script src="ui/jquery.ui.effect.js"></script>              

      
    <script >
         $(function(){
            
             $('#table-select-all').on('click', function () {
                var $this = $(this),
                // Test to see if it is checked
                checked = $this.prop('checked'),
                //Find all the checkboxes
                cbs = $this.closest('table').children('tbody').find('.case');
                // Check or Uncheck them.
                cbs.prop('checked', checked);
                //toggle the selected class to all the trs
                cbs.closest('tr').toggleClass('selected', checked);
            });
            $('tbody tr').on('click', function () {
                var $this = $(this).toggleClass('selected');
                $this.find('.case').prop('checked', $this.hasClass('selected'));
                         if (!$this.hasClass('selected')) {
                             $this.closest('table').children('thead').find('#table-select-all').prop('checked', false);
                         }
             });
                
                    // download_Single_File
                    $('.download_single').on('click', function(e){
                            e.preventDefault();
                            //Dont let the click bubble up to the tr
                            e.stopPropagation();
                            
                            
                            var Data = $(this).parent().siblings('td').eq(1).text();                      
                            
                            
                            $.post("deleteFiles.php",{fileDownload:Data},function(response){window.open(response,'Download');});
                     });
                     
                     
                    // delete_Single_File
                    $('.delete_single').on('click', function(e){
                            e.preventDefault();
                            //Dont let the click bubble up to the tr
                            e.stopPropagation();
                            
                            //vijay => alert('selected: ' + $(this).closest('tr').text());
                            //alert('selected: ' + $(this).parent().siblings('td').eq(1).text());
                            
                            //var data =  $(this).parent().siblings('td').eq(1).text();
                            var Data = $(this).parent().siblings('td').eq(1).text();
                            
                            
                            var $this = $(this),
                            c = confirm('Are you sure you want to delete this file?');
                            if(!c) { return false;}
                            $this.closest('tr').fadeOut(function(){ $(this).remove();});
                            $.post("deleteFiles.php",{fileName:Data},function(response){alert(response);});
                     });
                    $('a.deleteall').on('click', function(e){
                        e.preventDefault();
                        var $this = $(this), 
                        $trows = $this.closest('table').children('tbody').find('tr.selected'),
                        sel = !!$trows.length;
                           
                        //var data = $(this).closest('table').children('tbody').find('tr.selected').eq(0).text();
                        
                        //alert(x);
                        // Don't confirm delete if no rows selected.
                        if(!sel){
                            alert('No Files selected');
                            return false;
                        }
                        var c = confirm('Are you sure you want to delete the slected files?');
                        if(!c) { return false; }
                        $trows.fadeOut(function(){ $trows.remove();  });
                        //$.post("deleteFiles.php",{fileName:Data},function(response){alert(response);});
                        });
                    }); 
    </script>   
       
    <script>
        $(function() {
            $( "#dialog-modal" ).dialog({
                autoOpen: false,
                            modal:true ,
                            height:350,
                            width:500,
                            draggable: false,
                            resizable: false,
                    
                show: {
                    effect: "blind",
                    duration: 1000
                },
                hide: {
                    effect: "explode",
                    duration: 1000
                }
            });

            $( "#Upload" ).click(function() {
                $( "#dialog-modal" ).dialog( "open");
            });
        });
        
        //document.forms["frmUpload"].submit();
    </script>  
</head>