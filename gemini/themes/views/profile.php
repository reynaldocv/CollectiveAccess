<?php 
    $item = $this->getVar('entity');
    $labels = $this->getVar('labels');
    $attribute = $this->getVar('attribute');

    //print "<h2>Profile: (".$item->get("idno").") ".$item->get("preferred_labels")."</h2>";
    //print "<h2>Country: ".$item->get("ca_entities.nationality")."</h2>";   
    
    $names = $item->get("preferred_labels");    
    $query = $labels["prefix"]." ".$names." ".$labels["suffix"];
    
    $caracteres_sem_acento = array(
        'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Â'=>'Z', 'Â'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
        'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
        'Ï'=>'I', 'Ñ'=>'N', 'Å'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
        'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
        'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
        'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'Å'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
        'ú'=>'u', 'û'=>'u', 'ü'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f',
        'Ä'=>'a', 'î'=>'i', 'â'=>'a', 'È'=>'s', 'È'=>'t', 'Ä'=>'A', 'Î'=>'I', 'Â'=>'A', 'È'=>'S', 'È'=>'T',
    );
    $names = strtr($names, $caracteres_sem_acento);
    
    //var_dump($item);

    //$r = new ReflectionObject($item);

    /*echo $r->getName() .' {' . implode(', ', array_map(
     function($p) use ($v) {
         $p->setAccessible(true);
         return $p->getName() .': '. $p->getValue($v);
     }, $r->getProperties())) .'}';

    foreach(array_keys($item) as $key)
      echo $key."<br>";
    */
    print "<h3> Profile: (".$item->get("idno").") ".$item->get("preferred_labels")."</h3>";
    print "<h2> Nationality: ".$item->get("nationality")."</h2>";   
    //print "<h2> Profession -> : ".$item->get("ca_entities.dados_complementares.profissao_entidade")."</h2>";
    //print "<h2> Sex: -> ".$item->get("ca_entities.sex")."</h2>";    
    
    //print "<h2>Outros Nomes: ".$item->get("ca_entities.type_id")."</h2>";    

    //print "<h2>Datas importantes: ".$item->get("type_id")["display_text"]."</h2>";  
    //print $item->get("ca_entities.DadosBiograficos.LocalNascimento")." - ".$item->get("ca_entities.DadosBiograficos.AnoNascimento");
    //print $item->get("ca_entities.DadosBiograficos.LocalMorte")." - ".$item->get("ca_entities.DadosBiograficos.AnoMorte");

    //print "<h2>Dados complementarios: ".$item->get("type_id")["display_text"]."</h2>";    

    //print "<b>Description: </b><br>".$item->get("ca_entities.internal_notes")."<br>";    

    
?>
    <input type='hidden' id='idno' value='<?php print $item->get("rank") ?>'>
   

    <h3> <?php print $labels["t_query"] ?></h3>
    
    <div class="contenedor">
    <form action="#" id="formulario1">
      <div class="control-box rounded">
        <div class="control-box-left-content">
          <div class="simple-search-box"> Search: 
            <input id="consulta" type="text" value="<?php print $query ?>" size="80">

            <button id="btnConsultar" class="btn"><i class="fa fa-google">emini</i></button>

          </div>
        </div>
        <div class="control-box-right-content">
          </div>
      </div>                  
    </form>

      <br>
      
    <table style="width:100%">
      <tr>
        <td style="width:50%">   
          <h2><?php print $labels["t_attribute"] ?> :  </h2>     
          <textarea id="biography" name="biography" rows="30" cols="50"><?php print $item->get($attribute) ?></textarea>
          
        </td>
        <td style="width:50%">    
          <h2><?php print $labels["t_query"] ?> : </h2>     
          <textarea rows="30" cols="50" id="resultado">
          </textarea>      
      
        </td>
      </tr>
      <tr>
        <td style="width:50%">    
            <div class="control-box-left-content">
              <a href="#" onclick="save()" class="form-button">
                <span class="form-button" id="saveicon">
                  <i class="caIcon fa fa-check-square" style="font-size: 25px;">
                  </i>Save
                </span>
              </a>
            </div>
            <!--
            <div class="control-box-right-content">
              <a href="#" onclick="back()" class="form-button">
                <span class="form-button">
                  <i class="caIcon fa fa-backward " style="font-size: 25px;">
                  </i>Default value
                </span>
              </a>
            </div>
            -->
        </td>
        <td style="width:50%">  
          
		        <div class="control-box-left-content">
              <a href="#" onclick="add()" class="form-button">
                <span class="form-button">
                  <i class="caIcon fa fa-copy " style="font-size: 25px;">
                  </i>Add
                </span>
              </a>
            </div>
   	      <div class="control-box-right-content">
            <a href="#" onclick="remove()" class="form-button " style="">
              <span class="form-button ">
                <i class="caIcon fa fa-paste deleteIcon " style="font-size: 25px;">                
                </i>Delete and copy
              </span>
            </a>
          </div>
          
        </td>
      </tr>
    </table>

    <div style="color:red" id="status">        
    </div>

  <script>
    var menu = "<br><h2> <a class='sf-menu-disabled' href='<?php print caNavUrl($this->request, 'gemini', 'Gemini', 'Index'); ?>'><i class='fa fa-home' style='font-size: 25px;'></i> <?php print $labels["t_title"] ?></a></h2>";

    jQuery("#leftNavSidebar").html(menu);
    
    const formulario1 = document.querySelector("#formulario1");

    formulario1.addEventListener("submit", evento => {
      evento.preventDefault();

      const consulta = document.querySelector("#consulta").value.trim();
      const btnConsultar = document.querySelector("#btnConsultar");

      jQuery("#btnConsultar").html("Searching... <i class='fa fa-spinner fa-spin'></i>");
      jQuery("#btnConsultar").attr('disabled','disabled');
      // Desactivar el botón y mostrar mensaje de espera
      
      jQuery.getJSON('<?php print caNavUrl($this->request, '*', '*', 'QueryToGemini'); ?>', {consulta}, function(data) {	
        var html = data["results"];

			  jQuery("#resultado").html(html);
      
        jQuery("#btnConsultar").removeAttr('disabled');
        jQuery("#btnConsultar").html("<i class='fa fa-google'>emini</i>");
        //btnConsultar.disabled = false;
      
      })

    });  
    
    function add() {
      const resultado = document.querySelector("#resultado").value.trim();
      const biography = document.querySelector("#biography").value.trim();

      jQuery("#status").html("");

      jQuery("#biography").html(biography + "\n\n" + resultado);

    }

    function remove() {
      const resultado = document.querySelector("#resultado").value.trim();

      jQuery("#status").html("");

      jQuery("#biography").html(resultado);

    }

    function save() {
      const newBiography = document.querySelector("#biography").value.trim();
      const idno = document.querySelector("#idno").value.trim();

      jQuery("#saveicon").html("Saving... <i class='fa fa-spinner fa-spin' style='font-size: 25px;'></i>");

      jQuery.getJSON('<?php print caNavUrl($this->request, '*', '*', 'ModifyBiography'); ?>', {idno, newBiography}, function(data) {	
        var html = data["results"];

        jQuery("#status").html(html);
			  
        jQuery("#saveicon").html("<i class='caIcon fa fa-check-square' style='font-size: 25px;'></i>Save");
		  });
    }

    
 
  </script>