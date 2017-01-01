<!doctype html>
<head>
	<title>Dyfinit</title>
	<link rel="shortcut icon" href="img/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="css/sheet.css">
</head>
<body>
	<div id="content">
		<h1>Live example of Dyfinit</h1>
		<p>This is a simple example to show the ease of using Dyfinit for your projects in need of dynamic progressive loading. 
		Check out the <a href="./">documentation</a> if you wish to get started with the framework.</p>
		<p>The images featured in the example are all from <a href="https://pixabay.com">pixabay</a>.</p>


		<div id="example"></div>
	</div>
	

	
	<!-- Other libraries -->
	<script src="basic/ajax.js"></script>

	<!-- Dyfinit library -->
	<script src="dyfinit/linker.js"></script>
	<script src="dyfinit/build.js"></script>

	<script>

		// Randomly decide on a target class
		var targetClass = Math.round(Math.random()) === 0 ? "Example1": "Example2";

		// Create the Dyfinit element
		var example = new Dyfinit(
			document.getElementById("example"), // Target
			targetClass, // Target template php class
			3, // Load per call
			3, // Initial load amount
			20 // Buffert (%)
			);
	</script>
</body>