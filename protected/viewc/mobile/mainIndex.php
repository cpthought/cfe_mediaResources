<?php include Doo::conf()->SITE_PATH .  Doo::conf()->PROTECTED_FOLDER . "viewc//mobile/header.php"; ?>
<body>
	<div class="warpContent">
			<legend>Hi，<?php echo $data['staff']['0']['username']; ?></legend>
			<div class="indexNav">
              <a href="/addressBook">通讯录</a>
              <a href="/keyLibrary">在线锁库</a>
		    </div>
	</div>
</body>