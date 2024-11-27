<?php 

$qr_results = $this->getVar('entities');
$labels = $this->getVar('labels');
$attribute = $this->getVar('attribute');

?>

<h3> <?php print $labels['t_title'] ?></h3>
<p> </p>  
<div class="control-box rounded">
		<div class="control-box-left-content">
      <div class="simple-search-box">
      <?php print $labels['t_filter'] ?>: 
        <input class="form-control" id="myFilter" type="text" placeholder="">
      </div>
    </div>
	</div>

<?php


$count = 1;




?>

<div class="container">
  <table class="listtable">
    <thead>
      <tr>
        <th>#</th>
        <th>ID</th>       
        <th><?php print $labels['t_names'] ?>
        <th><?php print $labels['t_attribute'] ?>
        <th></th>
      </tr>
    </thead>
    <tbody id="myTable">

<?php 

/*caNavUrl($this->request, '', 'Search', 'objects', array('search' => 'entity_id:^ca_entities.entity_id/EntityRel:100'), 
array('dontURLEncodeParameters' => true)); ?>

//the URL looked like this:

//index.php/Search/objects/search/entity_id:8744/EntityRel:100
*/

$cnt = 0; 

while($qr_results->nextHit()) {  
  

  $id   = $qr_results->get("ca_entities.rank");
  $idno = $qr_results->get("ca_entities.idno"); 
  $name = $qr_results->get("ca_entities.preferred_labels"); 
  $bio  = $qr_results->get("$attribute");
  
  if (trim($bio) != "") 
    $bio = substr($bio, 0, 50)."...";
  
  $type = $qr_results->get("type_id");

  if ($type == "488" || True)
  {
    $cnt += 1;
    print "<tr><td>".$cnt."</td>"
  
    ?>
    <td>      
    <a href="<?php print caNavUrl($this->request, 'editor', 'entities', 'EntityEditor/Edit/entity_id/'.$id); ?>"> <?php echo $id ?></a>
    </td>
    <td>
      <?php 
        print $name;
      ?>
    <td>
    <?php 
        print $bio;
      ?>
   </td>
   <td>
   <form role="search" id="form-<?php print $id ?>"
        action="<?php print caNavUrl($this->request, 'gemini', 'Gemini', 'Profile'); ?>">
    
        <input type="hidden" name="idno" value="<?php print $id ?>"> </input>     
        
        <div class="control-box-center-content">
              <a onclick="document.getElementById('form-<?php print $id ?>').submit()" class="form-button">
                <span class="form-button">
                  <i class="caIcon fa fa-google " style="font-size: 18px;">
                  </i><span style="margin-left: -12px;">emini</span>
              </span>
            </a>
            </div>
    
    </form>
       
    
    <?php
      print "</td></tr>";

  }    
}

print "</table><br><br><br><br><br><br><br>";

/*while($qr_results->nextHit()) {
    print "Hit ".$count.": ".$qr_results->get('ca_objects.preferred_labels.name')."<br/>\n";
    $count++;
}*/
?>

<script>
$(document).ready(function(){
  $("#myFilter").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

  </tbody>
  </table>
  </div>
</div>
