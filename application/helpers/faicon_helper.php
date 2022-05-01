<?php
if (! function_exists("getfaicon")) {

    function getfaicon($index)
    {
        
        switch ($index){
            
            case  "Document":
                return '<i class="fa fa-book" aria-hidden="true" style="font-size:28px;"></i>';
             break;
             
            case  "Vehicle":
                return '<i class="fa fa-car" aria-hidden="true" style="font-size:28px;"></i>';
                break;
                
                
            case  "Device":
                return '<i class="fa fa-mobile" aria-hidden="true" style="font-size:28px;"></i>';
                break;
                
                
            case  "Person":
                return '<i class="fa fa-user" aria-hidden="true" style="font-size:28px;"></i>';
                break;
                
                
            case  "Livestock":
                return '<i class="fa fa-paw" aria-hidden="true" style="font-size:28px;"></i>';
                break;
                
                
            default:
                return '<i class="fa fa-question-circle" aria-hidden="true" style="font-size:28px;"></i>';
                

        }
        

    }
}

?>