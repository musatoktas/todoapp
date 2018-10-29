<?php
include 'veritabani.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>To Do App</title>
	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.js"></script>
</head>
<style type="text/css">
	#classItem {
		
	}
	#addButton {
		margin-left: 2%;
	}
	.checked { 
    text-decoration: line-through;
}
</style>
<body>
	
	<div class="ui inverted vertical masthead center aligned segment" style="background-color: #009999;">
        <div class="ui center aligned container">
            <div class="ui" style="background-color: #009999;">
              <!-- <a href="https://semantic-ui.com/examples/fixed.html#" class="header item"> -->
              	<h2> To Do App </h2>
      			<div class="ui centered icon input" >
      				
      				<input id="myInput" type="text" placeholder="Add an item...">
	      			
	      			<div class="ui orange right labeled icon button" id="addButton">Add<i class="search icon"></i></div>
    			</div>
      		<!-- </a> -->
            </div>
        </div>
    </div>

    <div class="ui container">
    	<div class="ui relaxed divided list" id="uolist">
		 	
			<!-- FOR DONECEK -->

<?php
			
		$sayi = 0;
			$sql_query = $db->query("SELECT * FROM items");
			
			if($sql_query->rowCount())
			{	
			
				foreach($sql_query as $selection)
				{
					$id = $selection["id"];
					
					$txt = $selection["acik"];

					$sayi +=1;
					?>
			<div class="item" style="padding-top: 0.5%; padding-bottom: 0.5%;"> 
	    		<div class="big content"> 
		    		<div class="ui six column grid"> 
		    			<div class="two column row"> 
		    				<div class="middle aligned column header" id="item-5">
		    					<div class="ui checkbox" >
									<input type="checkbox" name="example" onclick="bitti(this)" id="cb-<?php echo $sayi?>" >
									<label>
										<div class="content">
											<a class="header" id="h-<?php echo $sayi?>"> <?php echo $txt ?><?php echo $sayi?> </a>
										</div>
									</label>
								</div>
		    				</div> 
		    				<div class="right aligned column"> 
		    					<button class="ui small button red kapat" onclick="bas(this)" id="not-<?php echo $id?>"><i class="thumbs down white icon"></i>CLOSE</button> 
		    				</div> 
		    			</div> 
		    		</div> 
	    		</div> 
	    	</div>
		
					<?php
					
					
					
					
				}
				
			}
			
			
			
			?>


    	</div>
    </div>
<script>
// Create a "close" button and append it to each list item
// function newElement(){
// 	var inputValue = document.getElementById("myInput").value;
// 	console.log(inputValue);

	
// }

var sayi = <?php echo $sayi?> ;
console.log(sayi);

function bitti(eleman){


	var kety = eleman.id;
	var lefg = kety.split("-");
	var cdsa = lefg[1];

	var bslk = "#h-"+cdsa;


	$(bslk).toggleClass("checked");
}

$("#addButton").click(function(){
		var inputValue = document.getElementById("myInput").value;
		
		sayi += 1;
        
	 var bilgi = {
        parentid: sayi,
        eventid:  inputValue,
		islem: "set"
		
    }
  
    console.log(bilgi);

    $.ajax({
        type: 'post',
        url: 'handler.php',
        data: {query: bilgi},
        success: function(result) {
        $("#uolist").append(`

        	<div class="item" style="padding-top: 0.5%; padding-bottom: 0.5%;"> 
	    		<div class="big content"> 
		    		<div class="ui six column grid"> 
		    			<div class="two column row"> 
		    				<div class="middle aligned column header" id="item-5">
		    					<div class="ui checkbox" >
									<input type="checkbox" name="example" >
									<label>
										<div class="content">
											<a class="header" > `+inputValue+` </a>
										</div>
									</label>
								</div>
		    				</div> 
		    				<div class="right aligned column"> 
		    					<button class="ui small button red kapat" onclick="bas(this)" id="not-`+sayi+`"><i class="thumbs down white icon"></i>CLOSE</button> 
		    				</div> 
		    			</div> 
		    		</div> 
	    		</div> 
	    	</div>
    `)  	
 
	}
    });
});


  $(".ui small button red kapat").click(function(){
  		
		console.log("console"+ sayi);


		

      	$(this).parentsUntil("#uolist").slideUp();
  });




// Click on a close button to hide the current list item

// Add a "checked" symbol when clicking on a list item

function bas(eleman){

	var ids =  "#" + eleman.id;

	var mix = eleman.id;
	var spt = mix.split("-");
	var id = spt[1];




	//AJAX
	 var bilgi = {
        parentid: id,
		islem: "delItem"
		
    }
  
    console.log(bilgi);

    $.ajax({
        type: 'post',
        url: 'handler.php',
        data: {query: bilgi},
        success: function(result) {
			
			$(ids).parentsUntil("#uolist").slideUp();
	}
	})
};


// Create a new list item when clicking on the "Add" button
//alert(result);
</script>
</body>
</html>
