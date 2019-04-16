<table id="table_id" class="display">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Whatsapp</th>
            <th>Confirmación</th>
            <th>Mesa</th>
        </tr>
    </thead>
</table>
<script>
    $('#table_id').DataTable( {
        ajax: {
                url: baseUrl + 'etickets/getEtickets',
                dataSrc: ""
                },
    columns: [
        { data: 'name' },
        { data: 'surname'},
        { data: 'cellphone'},
        { data: 'confirmation'},
        { data: 'mesa' },
    ]
} );
</script>