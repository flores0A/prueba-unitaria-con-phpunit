</main>
<footer class="text-center">
    FARMACIA 2023
</footer>
<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
</script>
<script>
$(document).ready(function() {
    $("#tabla_id").DataTable({
        "pageLength": 5,
        "lengthMenu": [
            [3, 5, 25, 50],
            [3, 5, 25, 50]
        ],
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
        }
      
    });
});
</script>

<script>
function borrar(id) {
    // Muestra una alerta de confirmación antes de eliminar el registro
    Swal.fire({
        title: '¿Estás seguro?',
        text: 'No podrás revertir esto',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo'
    }).then((result) => {
        if (result.isConfirmed) {
            // Si el usuario confirma, redirige a la página de eliminación con el ID del registro
            window.location.href = 'index.php?txtID=' + id;
        }
    });
}
</script>

</body>

</html>