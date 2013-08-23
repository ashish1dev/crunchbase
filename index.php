<?php
include('simple_html_dom.php');
//echo "111";
// Create DOM from URL or file

$page=1;

if(isset($_GET['page']))
	$page=$_GET['page'];

//echo strlen(trim($page));

if (strlen(trim($page))==0){
	$url="http://www.crunchbase.com/funding-rounds?page=1";	
}
else{
	$url="http://www.crunchbase.com/funding-rounds?page=".$page;
}

//echo $url;
$html = file_get_html($url);

//echo $html;

echo "<center><h3>Auto-Generated Tweets</h3></center>";
$count=0;
if($page==1)
echo "<center>"."&nbsp;&nbsp;&nbsp;&nbsp;"."<a href='index.php?page=".($page+1)."'>Next Page</a></center>";
else
echo "<center><a href='index.php?page=1"."'>First Page</a>"."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"."<a href='index.php?page=".($page-1)."'>Previous Page</a>"."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"."<a href='index.php?page=".($page+1)."'>Next Page</a></center>";
// Find all "A" tags and print their HREFs
foreach($html->find('div#col2_internal') as $e) {
    //if($e.id="col2_internal")
		
		foreach($e->find('table') as $table)
		{
		echo "<table class='table table-hover table-bordered ' style='width:50%;align:center;margin-left:30%;margin-right:30%;'>";
			foreach ($table->find('tr') as $tr) {
			echo "<tr>";
				if($count!=0){
				
					$d=0;$date="";$name="";$round="";$size="";$investors="";
					foreach ($tr->find('td') as $td) {
						
						if($d==0){
							$date=trim($td->plaintext);
							echo "<td>".$date."</td>";
							}
						if($d==1){
							$name=trim($td->plaintext);
							echo "<td>".$name."</td>";
							}
						if($d==2){
							$round=trim($td->plaintext);
							echo "<td>".$round."</td>";
							}
						if($d==3){
							$size=trim($td->plaintext);
							echo "<td>".$size."</td>";
							}
						if($d==4){
									$investors=trim($td->plaintext);
									if($investors!="N/A"){
										$comma="";
										$investors="";
										foreach($td->find('a') as $inames){
											$investors=$investors.$comma.trim($inames->innertext);
											$comma=",";
										}
									}
									echo "<td>".$investors."</td>";
							}
							//echo $td;
							$d++;
							
					}
					if($investors!="N/A")
						$str="$investors"." invested ".$size." in ".$name;
					else
						$str=" ";
					
					echo "<td id='tweetmessage'><p style='display:inline;'>".$str."</p></td>";
					if(strlen(trim($str))>2){
						echo "<td><a href='https://twitter.com/share' class='twitter-share-button' data-text='$str' data-count='none'>Tweet</a></td>";
					}else{
						echo "<td> N/A </td> ";
					}
					
					
				}else{
					echo "<th>Date</th>"."<th>Name</th>"."<th>Round</th>"."<th>Size</th>"."<th>Investors</th>"."<th>Generated Tweet</th>";
				}
				$count++;
				echo "</tr>";
			}
			echo "</table>";
			}
}

echo "<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>";
?>


    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;

      }
	  table{
			word-wrap: break-word;
				margin:20px;
			width:60%;
			align:center;
	  }
	  
	table thead tr th {
	
		text-align:center;
		background-color:rgb(247,247,249);
		cursor: pointer;	
	}
	
	
	#tweetmessage{
		word-wrap: break-word;
		width:40%;		
	}
	
	.wrapped {
				/* wrap long urls */
				white-space: pre;           /* CSS 2.0 */
				white-space: pre-wrap;      /* CSS 2.1 */
				white-space: pre-line;      /* CSS 3.0 */
				white-space: -pre-wrap;     /* Opera 4-6 */
				white-space: -o-pre-wrap;   /* Opera 7 */
				white-space: -moz-pre-wrap; /* Mozilla */
				white-space: -hp-pre-wrap;  /* HP Printers */
				word-wrap: break-word;      /* IE 5+ */
				
				}
			pre {
				/* general styles */
				font: 11px/1.5 Monaco, "Panic Sans", "Lucida Console", "Courier New", Courier, monospace, sans-serif;
				border: 5px solid #ccc;
				background: #eee;
				padding: 10px;
				}
				
				

    </style>
    <link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="bootstrap/js/html5shiv.js"></script>
    <![endif]-->

<style>

td th{
	padding:30px;
}

</style>

<script type="text/javascript" src="jquery-1.7.1.min.js"></script>


<script type="text/javascript" src="jquery.tablesorter.js"></script> 
