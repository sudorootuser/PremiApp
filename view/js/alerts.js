const ajax_form = document.querySelectorAll(".AjaxForm");

function submit_ajax_form(e) {
    e.preventDefault();

    // Form captured attributes
    let data = new FormData(this);
    let method = this.getAttribute("method");
    let action = this.getAttribute("action");
    let type = this.getAttribute("data-form");


    let headers = new headers();
    let config = {
        method: method,
        headers: headers,
        mode: 'cors',
        cache: 'no-cache',
        body: data
    }

    let alert_text;

    if (type == "save") {
        alert_text = "Los datos quedaan guardados en el sistema";
    } else if (type == "delete") {
        alert_text = "Los datos serán eliminados completamente del sistema";
    } else if (type == "update") {
        alert_text = "Los datos serán actualizados";
    } else {
        alert_text = "Quieres realizar la operación solicitada";
    }

    Swal.fire({
        title: 'Estas Seguro',
        text: alert_text,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            fetch(action, config)
                .then(respuesta => respuesta.json())
                .then(respuesta => {
                    return ajax_alets(respuesta);
                });
        }
    })
}

ajax_form.forEach(
    forms => {
        forms.addEventListener("submit", send_ajax_form);
    });

function ajax_alets(alerta) {
    if (alert.Alert === "simple") {
        Swal.fire({
            title: alerta.Title,
            text: alerta.Text,
            type: alerta.type,
            confirmButtonText: 'Aceptar'
        });
    } else if (alerta.Alerta === 'reload') {
        Swal.fire({
            title: alerta.Title,
            text: alerta.Text,
            type: alerta.Typo,
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.value) {
                location.reload();
            }
        });
    } else if (alerta.Alerta === "clear") {
        Swal.fire({
            title: alerta.Title,
            text: alerta.Text,
            type: alerta.Typo,
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.value) {
                document.querySelector(".ajax_form").reset();
            }
        });
    } else if (alerta.Alert === "redirect") {
        // console.log(alerta.url);
        window.location.href = alerta.URL;
    }
}

