<html>
	<head>
		<style>
			h1{
				background-color:#3399ff;
				margin:0px;
				padding:20px;
				text-align:center;
				color:white;
				font-family:Broadway;
				font-size:40px;
			}
			
			ul{
				list-style-type:none;
				margin-bottom:2px;
				padding:0px;
				line-height:50px;
				background-color:#3399ff;
			}
			.clearfix::after {
				content: "";
				clear: both;
				display: table;
			}
			.drop{
				float:left;
				background-color:#3399ff;
				display:block;
				position:relative;
				min-width:150px;
			}
			.drop a{
				color:white;
				text-decoration:none;
				padding:20px;
			}
			.dropdown{
				display:none;
				position:absolute;
				background-color:#66a3ff;
			}
			.drop:hover > ul{
				display:block;
			}
			.dropdown:hover > li{
				display:block;
			}
			.drop:hover{
				background-color:#66a3ff;
			}
			ul ul ul{
				background-color:#66a3ff;
				top:0%;
				left:100%;
				min-width:150px;
			}	
			div{
				position:relative;
				left:0;
				top:70px;
				width:100%;
				//border:solid;
			}
			
		</style>
	</head>
	<body>
		<h1> SHOLA ECOMERCE </h1>
		<ul class = "clearfix">

			<li class = "drop"> <a href = "#"> Category </a> 
				<ul class = "dropdown"> 
					<li class = "drop"> <a href = "#"> Fashion </a> 
						<ul class = "dropdown">
							<li class="drop"> <a href = "#"> Men's </a>
								<ul class = "dropdown">
									<li > <nav href = "dynamicwebpages2.php?page=MC" value="MC"> Clothes </a> </li>
									<li > <nav href = "dynamicwebpages2.php" value="MS"> Shoes</a> </li>
								</ul>
							</li>
							<li class="drop"> <a href = "#"> Women's</a>
                                 <ul class = "dropdown">
									<li > <a href = "#"> Clothes </a> </li>
									<li > <a href = "#"> Shoes</a> </li>
								</ul>
							</li>
							<li class="drop"> <a href = "#"> Kids and Babies</a>
                                 <ul class = "dropdown">
									<li > <a href = "#"> Clothes </a> </li>
									<li > <a href = "#"> Shoes</a> </li>
								</ul>
							</li>
						</ul>
					</li>
					<li class = "drop"> <a href = "#"> Electonics </a> 
						<ul class = "dropdown">
							<li> <a href = "#"> Computer </a> </li>
							<li> <a href = "#"> Phones </a> </li>
							<li> <a href = "#"> Tablates </a> </li>
							<li> <a href = "#"> TVs </a> </li>
							<li> <a href = "#"> Computeraccessory </a> </li>
						</ul>
					</li>
					<li class = "drop"> <a href = "#">Books </a> 
						<ul class = "dropdown">
							<li> <a href = "#"> Fiction</a> </li>
							<li> <a href = "#"> Science </a> </li>
						</ul>
					</li>
					<li class = "drop"> <a href = "#"> Furniture </a> 
						
					</li>
				</ul>
			</li>
			
		</ul>
		<div>
			<img src = "">
		</div>
	</body>
</html>