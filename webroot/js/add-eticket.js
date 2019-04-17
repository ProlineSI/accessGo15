

$(document).on("change" , "#type" , function() {
    if($('#type option:selected').val() == 'despuesDeCena'){
        $('#mesa').val(0);
        $('#mesa-container').hide();
        $('#tipo-de-entrada-container').hide();
    }else{
        $('#mesa').val(null);
        $('#tipo-de-entrada-container').show();
        $('#mesa-container').show();
    }
    
});


$(document).on("change" , "#tipo-de-entrada" , function() {
if($('#tipo-de-entrada option:selected').val() == 'grupoFamiliar'){
    var input = '<label class="control-label" for="quantity">Cantidad de Personas</label><input type="number" name="quantity" required="required" id="quantity" class="form-control" value="1">';
    $('#quantity-container').append(input);

    window.localStorage.setItem('nombre', $('#name').val());
            
      
    $('#name').val('Familia');
}else{
    var name = window.localStorage.getItem('nombre');
    window.localStorage.setItem('nombre', null);
    $('#name').val(name);
    $('#quantity-container').empty();
}
});