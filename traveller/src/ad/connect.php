<?php
/**
 * autoloader
 */
   
   if($_SERVER["REQUEST_METHOD"]=="POST")
   {
     $ldp=new LdapConnect("DEUDCFRAN2002.grouphc.net", 389);
     $conn=$ldp->tstConnect();
     var_dump($conn);
     if(isset($ldp) && isset($conn))
     {
       $ldp->setDomain("grouphc.net");
       $ldp->setDc("DC=grouphc,DC=net");
       $ldp->setOU("OU=Users,OU=GOC,OU=GIT");
       $ldp->setUsername("pafloria");
       $ldp->setPassword("memoryOfKashmere1913");
       $ldp->searchConn($conn);
     }
   }
  ?>
