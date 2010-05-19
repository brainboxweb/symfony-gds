<?php
print_r($_POST);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"  "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Test News Item | NAM Administration Website</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="en" />

<link href="/nam/admin/css/s.css" type="text/css" rel="stylesheet" />
<link href="/nam/admin/css/calendar.css" type="text/css" rel="stylesheet" />



<link href="/nam/admin/css/datepicker.css" type="text/css" rel="stylesheet" />


<script type="text/javascript" src="/nam/admin/js/jquery.js"></script>
<script type="text/javascript" src="/nam/admin/js/ui.datepicker.js"></script>
<!-- Attach the datepicker to dateinput after document is ready -->
<script type="text/javascript" charset="utf-8">
     
     $(document).ready(function() {
          
          //Date picker globals;
          $.datepicker.setDefaults({showOn: 'both', buttonImageOnly: true, 
                buttonImage: 'images/calendar.gif', buttonText: 'Calendar',dateFormat: 'dd-mm-yy', closeAtTop: true});
          
          
          
          // Get the value of published and give to the date1
          temp =  $("#published").val();
          $("#date1").val(temp);
          calendar1 = $("#date1").datepicker();
          
          
          
          
          
          
          
          //get the value of depublish and give to date 2
          temp =  $("#depublish").val();
          if(!temp){
               var d = new Date();
               temp = ("0" + (d.getDate() ) ).slice(-2) + '-' + ("0" + (d.getMonth()+2) ).slice(-2) + '-' + d.getFullYear();
              
          }
          
          $("#date2").val(temp);
          calendar2 = $("#date2").datepicker();
          
         $(calendar2).click(function() {
          
               $("#date_remove2").checked()=true;
               
          
         });
          
         
          
         
          $("#submit1").click(function() {
              
              alert["submitting"];
               
               
               // Get the value of date1 and give to the published
               temp =  $("#date1").val(); 
               $("#published").val(temp);
               
               //Check the value of date2
               checked  = $(".date_remove:checked").val();
               if(checked=="never"){
                    temp="";
               } else {
                    temp =  $("#date2").val(); 
               }
               
               $("#depublish").val(temp);
               
               
               
               document.forms[0].submit();
          });
        
         
          
          
     });
</script>

<link href="/nam/admin/css/flexi.css" type="text/css" rel="stylesheet"  />
<script type="text/javascript" src="/nam/admin/js/validate_form.js" ></script>

<script type="text/javascript" src="/nam/admin/js/tooltips.js" ></script>

<link rel="Shortcut Icon" href="/nam/favicon.ico" />

</head>
<body>
     <!--
<div id="logo"><img src="images/logo.gif" /></div>

-->


<div id="breadcrumb">
<a href="/nam/admin/">Home</a> &gt; <a href="/nam/admin/news">News</a> &gt; Test News Item</div>
     
<!--
<div id="quicklinks">
   <a href="<br />
<b>Notice</b>:  Undefined variable: baseURL in <b>C:\wamp\www\nam\admin\template.php</b> on line <b>56</b><br />
">Home</a> |	<a href="<br />
<b>Notice</b>:  Undefined variable: baseURL in <b>C:\wamp\www\nam\admin\template.php</b> on line <b>56</b><br />
help">Help</a> 	| <a href="<br />
<b>Notice</b>:  Undefined variable: baseURL in <b>C:\wamp\www\nam\admin\template.php</b> on line <b>56</b><br />
contact">Contact BRAINBOX</a>
	
</div>     
-->

<!-- START topnavigation -->
<dl id="menu">
<dd><a href="/nam/admin/news" class="current">News</a></dd><dd><a href="/nam/admin/events" >Events</a></dd><dd><a href="/nam/admin/navigation" >Navigation</a></dd><dd><a href="/nam/admin/orphans" >Orphans</a></dd></dl>


<!-- END topnavigation -->









<!-- END navigation -->



     







<!-- START centercontent -->
<div id="centercontent">


<h1>Test News Item</h1>
<div id="test">Hello</div>
				<form action="/nam/admin/tester.php" method="post" name="updateflexiItem" id="updateflexiItem">

				<input name="main" id="main" type="hidden" value="1" />
				<input name="id" id="id" type="hidden" value="336" />
				
				<table class="form" border=0>
					<tr>
						<td class="col1">
							<div class="container">
								<label for="title">Title*</label>
								<input name="title" id="title" type="text" value="Test News Item" class="long checkRequired" />

							</div>
				
							<div class="container">
								<label for="subtitle">Subtitle</label> - delimit with "|" if more than one
								<input name="subtitle" id="subtitle" type="text" value=""  class="long" />
							</div>
							
							<div class="container">
								<label for="path">Path</label> - will be created automatically if left blank
								<input name="path" id="path" type="text" value="test-news-item"  class="long" />

							</div>
				
							<div class="optionalContainer">
								<!-- Hide the Meta info -->
								<span class="hastooltip" >More...</span>
								
								<div class="optional">
									<div class="container">
										<label for="metaTitle">Meta Title</label> - will be created from Title if blank
										<input name="metaTitle" id="metaTitle" type="text" value="" class="long" />

									</div>
									<div class="container">
										<label for="metaDescription">Meta Description </label> - will be created from subtitle/body if blank
										<textarea rows="5" cols="80" name="metaDescription" id="metaDescription" class="description"></textarea>
									</div>
								</div>
							</div>
						</td>

						<td>
							<!-- Sorry chaps... threw this one in from a distance! -->
							<input type="checkbox" name="featured" name="featured"  /><label for="featured">Featured</label>
						</td>
                                             <td class="pending">
                                                  <div class="calender_container">
                                                       <h3><label for="date1">Publish Date</label></h3>
                                                       <input type="text" id="date1" style="width:12em" name="date1" class="date" value="17-06-2008"/>

                                                     
                                                       
                                                       <h3>Expiry Date</h3>
                                                      
                                                       <input type="radio" id="date_remove1" name="date_remove" class="date_remove" value="never" />
                                                       <label for="date_remove1">Never Expire</label>
                                                       
                                                       <br />

                                                       <input type="radio" id="date_remove2" name="date_remove" class="date_remove" value="date" />
                                                       <label for="date_remove2">
                                                       <input type="text" id="date2" name="date2" class="date" checked="checked" value="16-07-2008" />
                                                       </label>
                                                                  
                                                  </div>
                                                  
                                                  <input type="hidden" id="published" name="published" value="17-06-2008" />
                                                  <input type="hidden" id="depublish" name="depublish" value="" />

                                             </td>

					</tr>
					<tr>
						<td colspan="3" class="body">
							<input name="submit1" id="submit1" value="Save" type="button" style="float:right"  />
							<br />
							<label for="body">Body</label>&nbsp;&nbsp;&nbsp;&nbsp;
							<div class="container">
								<textarea rows="20" cols="80" name="body" id="body" ></textarea>

							</div>
						</td>
					</tr>
					<tr>
						<td colspan="3" class="submit" >
							<input name="submit2" id="submit2" value="Save" type="button" method="post"/>
						</td>
					</tr>
				</table>

			</form>
			
			<!-- images -->
			<!-- Image names are changed, but there is no image manipulation -->
			<form action="/nam/admin/news?id=336" method="post" enctype="multipart/form-data" name="addImage" id="addImage">
				<input name="id" id="id" type="hidden" value="336" />
				<input type=hidden name="MAX_FILE_SIZE" value="1048576" />
				
				<h2>Images</h2>
				
				<table summary="layout" class="images">

					<tr>
						<td class="label"><label for="image[0]">Main</label></td>
						<td class="path"><input type="file" name="image[0]" size="60" /></td>
						<td class="view"><a href="php/view_object.php?res=336">View main image</a></td>
					</tr>
					<tr>
						<td class="label"><label for="image[1]">Thumb</label></td>

						<td class="path"><input type="file" name="image[1]" size="60" /></td>
						<td class="view"><a href="php/view_object.php?res=336-thumb">View thumb image</a></td>
					</tr>
					<tr>
						<td class="label"><label for="image[2]">Featured</label></td>
						<td class="path"><input type="file" name="image[2]" size="60" /></td>
						<td class="view"><a href="php/view_object.php?res=336-featured">View featured image</a></td>

					</tr>
					<tr>
						<td class="label"><label for="image[3]">Landing</label></td>
						<td class="path"><input type="file" name="image[3]" size="60" /></td>
						<td class="view"><a href="php/view_object.php?res=336-landing">View landing image</a></td>
					</tr>
					<tr>
						<td class="submit" colspan="3"><input type="submit" value="Add/Update Image(s)" /></td>

					</tr>
				</table>
			</form>
			
<div class="spacer">&nbsp;</div>
<div id="bottomlinks">
<a href="#">Top</a> | 
 <a href="/nam/admin/">Home</a> 
 
</div>


</div>
<!-- END centercontent -->





<!--start ABOLSUTELY positioned stuff -->







<!-- START footer -->
<div id="footer">


<div class="spacer">&nbsp;</div>
</div>
<!-- END footer -->




</div>
<!--END Center Container-->

</body>
</html>

<p>Time Taken 0.037209033966064