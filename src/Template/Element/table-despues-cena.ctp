<style>
.head th{
    font-size: 20px;
}
</style>
<table id="example" class="table table-striped table-bordered">
        <thead class = 'head'>
            <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Whatsapp</th>
            <th>Confirmación</th>
            </tr>
        </thead>
        
    </table>

    <script>
    $(document).ready(function() {
    $('#example').DataTable( {
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
} );});
</script>