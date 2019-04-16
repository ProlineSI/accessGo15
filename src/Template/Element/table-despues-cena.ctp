<table id="table_despues_cena" class="display">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Whatsapp</th>
            <th>Confirmación</th>
            
        </tr>
    </thead>
</table>
<script>
    $('#table_despues_cena').DataTable( {
        ajax: {
                url: baseUrl + 'etickets/getEtickets',
                dataSrc: ""
                },
    columns: [
        { data: 'name' },
        { data: 'surname'},
        { data: 'cellphone'},
        { data: 'confirmation'}
    ]
} );
</script>