<xml:namespace ns="urn:schemas-microsoft-com:vml" prefix="v" />

<v:roundrect arcsize=".04" fillcolor="#000">
<center>
<?php
    if($_REQUEST['mod']==='shownews'){
        fl_text($_REQUEST['p']);
    }
    else if($_REQUEST['mod']==''){
        fl_texts();
        

    }
    else{
        echo "46";
    }
?>

</v:roundrect>
</center>
<BR/>
