<?php
     //end autoloader
    class GeneralHeader implements HeaderInterface
    {
        private $util;//should be class context in case more methods are added
        function __construct(Util $ut)//attempting dependency injection
        {
            try
            {
                $this->util=$ut;//util init
            }
            catch (Exception $e)
            {
                echo 'Error GeneralHeader constructor, unable to load Util class ' . $e;
            }
            $this->generalHeader();//launch header on creation
        }
        public function generalHeader()//definition of a general header, can be used anywhere
        {//converting the string to general using PHPs superglobals
            //var_dump($this->util)
            //echo $this->util->getRelativeAddressingChar();
           echo '
            <header class="page-header" id="headr"> <!-- komplet cely header moze byt dynamicky linkovany -->
    				<nav class="navbar navbar-inverse navbar-fixed-top bottom-margin" id="hlavicka">
    			    	<div id="nhead" class="navbar-header"><!-- dolezite koli mechanike 3-bar spuste -->
    			    		<button class="navbar-toggle pull-left aux-navbar-left" onclick="temporaryEraseConditions()"  data-toggle="collapse" data-target="#mainNav" id="bars">
    							<span class="icon-bar"></span>
    							<span class="icon-bar"></span>
    							<span class="icon-bar"></span>
    			    		</button><!-- logo -->
    			    		<a class="navbar-left" >
    			    			<object type="image/svg+xml" data="'. $this->util->getSelfRoot().$this->util::img . $this->util->getRelativeAddressingChar() .'floppy.svg" id="logo">
    			    				Objects not supported in your browser
    			    			</object>
    			    		</a>
    			    	</div>
    			    	<div class="collapse navbar-collapse " id="mainNav">
    						<ul class="nav navbar-nav arcade-font">
    							<li class="vertical-separator-left"><a href="'.$this->util->getSelfRoot().'index.php">Home</a></li>
    							<li ><a href="'. $this->util->getSelfRoot() . $this->util::html. $this->util->getRelativeAddressingChar() .'about.php">About</a></li>
    							<li ><a href="'. $this->util->getSelfRoot() . $this->util::html. $this->util->getRelativeAddressingChar() .'software.php">Software</a></li><!-- nic moc, ale bude vle JS -->
    				    		<!--<li ><a href="#">Music</a></li>--> <!-- pride neskor -->
    				    		<li class="dropdown">
    				    			<a class="dropdown-toggle" data-toggle="dropdown" href="#">
    				    				Miscellanous
    				    				<span class="caret">
    				    				</span>
    				    			</a>
    				    			<ul class="dropdown-menu"><!-- to be done -->
    				    				<li><span><img id="refe" src="'. $this->util->getSelfRoot() . $this->util::img. $this->util->getRelativeAddressingChar() .'references.png" alt="references"/><a href="'.
                                         $this->util->getSelfRoot().$this->util::html. $this->util->getRelativeAddressingChar() .'90swebsites.php">90\'s websites</a></span></li>
    				    				<li><span><img id="ninety" src="'.$this->util->getSelfRoot().$this->util::img. $this->util->getRelativeAddressingChar() .'90s.png" alt="gallery"/><a href="'.
                                         $this->util->getSelfRoot().$this->util::html. $this->util->getRelativeAddressingChar() .'music-gal.php">Music</a></span></li>
    				    				<li><span><img id="gms" src="'.$this->util->getSelfRoot().$this->util::img. $this->util->getRelativeAddressingChar() .'cd.png" alt="games"/><a href="'.
                                         $this->util->getSelfRoot().$this->util::html.$this->util->getRelativeAddressingChar() .'games-gal.php">Games</a></span></li>
    				    			</ul>
    				    		</li>
    				    	</ul>
    				    	<ul class="nav navbar-nav navbar-right arcade-font">
    				    		<!-- popovers -->'.$this->detectSession().'
    				    	</ul>
    				    	<div id="login-form" class="hide">
    					    	<form class="navbar-form navbar-left" method="post" action="'.$this->util->getSelfRoot().$this->util::php.$this->util->getRelativeAddressingChar().'login.php">
    					    		<div class="form-group">
    									<input type="text" class="form-control" maxlength ="4" name="uname" placeholder="username"/>
    									<input type="password" class="form-control" maxlength="4" name="pwd" placeholder="password"/><br/>
    									<input type="submit" class="btn btn-primary"/>
    					    		</div>
    					    	</form>
    				    	</div>
    			    	</div>
    			    	<div class="progress thin-progressbar" id="progress"><!-- need to overload in .css file -->
    			    		<span class="progress-bar pb-details" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" role="progressbar">
    			    		</span>
    			    	</div>
    			    </nav>
    			</header>
            ';
        }
        private function detectSession()//decides the content
        {
            echo '<script>console.log("caught session: '.session_status().'");</script>';
            if(isset($_SESSION["username"]))//user logged in so serve appropriate content
            {
                return '<li><a href="#" id="profile" class="beon vertical-separator-right"
                        >'.$_SESSION["username"].'<span class="glyphicon glyphicon-user"></span></a>
                        </li>
                        <li><a id="logout" href="#"
                        onclick="logout(\''.$this->util->getSelfRoot().'logout.php\', \''.$_SESSION["username"].'\', \''.$_SESSION["password"].'\')"
                         clas="beon-neon">Logout <span class="glyphicon glyphicon-log-out"></span></a>
                        </li>';
            }
            else//casual stuff
            {
                return '<li><a href="#" id="login" class="beon vertical-separator-right" data-container="body" data-toggle="popover" title="Enter Credentials"
                    data-placement="bottom" onclick="setPopoverFlag()">
                        Log In <span class="glyphicon glyphicon-log-in"></span></a>
                </li>
                <li><a onclick="initModal();navbarCorrection()" id="register" href="#" class="beon-neon">Register <span class="glyphicon glyphicon-user"></span> </a></li>';
            }
        }
    }

 ?>
