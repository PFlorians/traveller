<?php
   namespace traveller;

   class LdapConnect
   {
     private $radic;
     private $port;
     private $dn;
     private $ou;
     private $username;
     private $password;
     private $domain;
     private $ds;

     function __construct($radic, $port)
     {
       $this->radic=$radic;
       $this->port=$port;
     }
     public function tstConnect()
     {
        try {
          return ldap_connect($this->radic, $this->port);
        } catch (Exception $e) {
          echo "chyba pri pripojeni: " . $e;
          return null;
        }
     }
     public function searchConn($connection)
     {
       var_dump($connection);

       if(isset($connection) && isset($this->ou) && isset($this->domain) && isset($this->dn) && isset($this->password)
       && isset($this->username))
       {
          $this->ds=$this->ou.",".$this->dn;
         var_dump($this->ds);
         ldap_set_option($connection, LDAP_OPT_PROTOCOL_VERSION, 3);
         ldap_set_option($connection, LDAP_OPT_REFERRALS, 0);
         $dn=$this->ou .",". $this->domain;
         $bind=ldap_bind($connection, $this->username ."@".$this->domain, $this->password);
         $check=ldap_search($connection, $this->ds, '(&(objectClass=User)(samAccountName='.$this->username.'))');
         if($check)
         {
           echo('Connection OK, user verified');
         }
         else {
           echo('something went wrong '. var_dump($bind) . " check: " . $check);
         }
       }

     }
     public function setDomain($domain)
     {
       $this->domain=$domain;
     }
     public function setDc($dn)//pass like DC=grouphc, DC=net
     {
       $this->dn=$dn;
     }
     public function setOU($ou)
     {
       $this->ou=$ou;
     }
     public function setUsername($user)
     {
       $this->username=$user;
     }
     public function setPassword($pw)
     {
       $this->password=$pw;
     }
   }

 ?>
