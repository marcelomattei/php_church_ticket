<script>
    $(document).ready(function() {
      $("#second_step_reservation").hide();
      $("#btn_finish_reservation").hide();
    });

    $("#btn_proceed_reservation").click(function(){
      update_html_input_fields();
      $("#btn_proceed_reservation").hide();
      $("#second_step_reservation").show();
      $("#btn_finish_reservation").show();
    });

    function update_html_input_fields(){
      var quantity = $("#inputQuantity").val();
      create_input_fields(quantity);
    }

    $("#inputQuantity").change(function(){
      update_html_input_fields();
    });

    function create_input_fields(quantity) {
      $("#second_step_reservation").empty();
      
      var table = "<table class='table'>" +
                    "<thead>" +
                        "    <tr>" +
                        "        <th>&nbsp;</th>" +
                        "        <th>Nome</th>" +
                        "        <th>RG</th>" +
                        "    </tr>" +
                        "</thead>" +
                        "<tbody>";

      for(i = 1; i <= quantity; i++){
        table += 
                "<tr>" +
                " <td>" + i + "</td>" +
                " <td><input type='text' autocomplete='off' size='75' class='form-control' name='name[]' id='inputName' aria-describedby='nameHelp' placeholder='Nome' required></td>" +
                " <td><input type='text' autocomplete='off' size='15' class='form-control' name='taxId[]' id='inputTaxId' aria-describedby='taxIdHelp' placeholder='RG' required></td>" +
                "</tr>";
      }
      table += "</tbody></table>";
      $("#second_step_reservation").append(table);
    }
  </script>