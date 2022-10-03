<script>
    let btn_exit = document.querySelector(".btn-exit-system");

    btn_exit.addEventListener('click', function(e) {
        e.preventDefault();

        Swal.fire({
            title: '¿Estas seguro que quieres cerrar la sesion?',
            text: "La sesion actual se cerrara y saldras del sistema!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, salir!',
            cancelButtonText: 'No, cancelar'
        }).then((result) => {
            if (result.value) {
                let url = '<?php echo SERVERURL; ?>ajax/ajaxLogin.php';
                let token = '<?php echo $cl->encrypt_decrypt('encrypt', $_SESSION['token_spm']); ?>';

                let user = '<?php echo $cl->encrypt_decrypt('encrypt', $_SESSION['userName_spm']); ?>';


                let data = new FormData();
                data.append("token", token);
                data.append("user", user);

                fetch(url, {
                        method: 'POST',
                        body: data
                    })
                    .then(answer => answer.json())
                    .then(answer => {
                        return ajax_alets(answer);
                    });
            }
        });
    });
</script>