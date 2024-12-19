<?php

session_destroy();

echo '<script>

	localStorage.removeItem("token_admin");
	window.location = "/";

</script>';