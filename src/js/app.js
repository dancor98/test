document.addEventListener("DOMContentLoaded", function () {
  var form = document.getElementById("FormularioInterno");
  var submitButton = document.getElementById("botonSubmit");

  form.addEventListener("submit", function (event) {
    // Deshabilitar el botón para prevenir múltiples envíos
    submitButton.disabled = true;
    submitButton.value = "Cargando..."; // Opcional: Cambia el texto del botón para indicar que está en proceso.
  });
}); //bloquea el boton de submit para emitar carga doble

document.addEventListener("DOMContentLoaded", function () {
  function getQueryParams() {
    let params = {};
    window.location.search
      .substring(1)
      .split("&")
      .forEach(function (param) {
        let parts = param.split("=");
        params[parts[0]] = decodeURIComponent(parts[1] || "");
      });
    return params;
  }

  let params = getQueryParams();
  if (params.estado) {
    let estado = params.estado;
    let modalId;

    switch (estado) {
      case "exito":
        modalId = "exito";
        break;
      case "error_abrir_archivo":
        modalId = "error_abrir_archivo";
        break;
      case "error_procesamiento":
        modalId = "error_procesamiento";
        break;
      case "error_extension":
        modalId = "error_extension";
        break;
      case "error_carga":
        modalId = "error_carga";
        break;
      default:
        return; // Si el estado no es reconocido, no hacer nada
    }

    if (modalId) {
      var myModal = new bootstrap.Modal(document.getElementById(modalId));
      myModal.show();
    }
  }
});

document.addEventListener("DOMContentLoaded", function () {
  var backButton = document.getElementById("backButton");
  if (backButton) {
    backButton.addEventListener("click", function () {
      if (document.referrer !== "") {
        window.history.go(-1);
      } else {
        // Redirigir según el rol del usuario
        if (rolUsuario === "1") {
          window.location.href = "/admin/dashboard";
        } else if (rolUsuario === "0") {
          window.location.href = "/colaborador/dashboard";
        } else {
          // Fallback en caso de rol no identificado
          window.location.href = "/";
        }
      }
    });
  }
}); //boton de volver

document.addEventListener("DOMContentLoaded", function () {
  var filtroPeriodo = document.getElementById("filtroPeriodo");

  // Leer el valor del parámetro 'periodo' de la URL y establecer el valor en el dropdown
  var urlParams = new URLSearchParams(window.location.search);
  var mes = urlParams.get("periodo");
  if (mes) {
    filtroPeriodo.value = mes;
  }

  // Actualizar la URL cuando se selecciona un mes en el filtro
  filtroPeriodo.addEventListener("change", function () {
    var filtro = filtroPeriodo.value;
    var url = new URL(window.location.href);
    if (filtro) {
      url.searchParams.set("periodo", filtro);
    } else {
      url.searchParams.delete("periodo");
    }
    window.history.pushState({}, "", url);
    window.location.reload(); // Recargar la página con el nuevo filtro
  });
});

document.addEventListener("DOMContentLoaded", function () {
  var filtroEstado = document.getElementById("filtroEstado");

  // Leer el valor del parámetro 'estado' de la URL y establecer el valor en el dropdown
  var urlParams = new URLSearchParams(window.location.search);
  var status = urlParams.get("estado");
  if (status) {
    filtroEstado.value = status;
  }

  // Actualizar la URL cuando se selecciona un estado en el filtro
  filtroEstado.addEventListener("change", function () {
    var filtro = filtroEstado.value;
    var url = new URL(window.location.href);
    if (filtro) {
      url.searchParams.set("estado", filtro);
    } else {
      url.searchParams.delete("estado");
    }
    window.history.pushState({}, "", url);
    window.location.reload(); // Recargar la página con el nuevo filtro
  });
});

document.addEventListener("DOMContentLoaded", function () {
  var hoy = new Date();
  hoy.setDate(hoy.getDate() + 1); // Sumamos un día a la fecha actual para obtener mañana
  var manana = hoy.toISOString().split("T")[0];

  var desde = document.getElementById("desde");
  var hasta = document.getElementById("hasta");
  var cantidad = document.getElementById("cantidad");
  var cantidad_dias = document.getElementById("cantidad_dias");
  var botonSubmit = document.getElementById("botonSubmit");

  // Establecemos el valor mínimo para el campo "desde" como mañana
  if (desde) {
    desde.setAttribute("min", manana);

    desde.addEventListener("change", function () {
      // Establecemos el valor mínimo para el campo "hasta" como el valor seleccionado en "desde"
      if (hasta) {
        hasta.setAttribute("min", desde.value);
      }
      actualizarCantidadDias();
    });
  }

  if (hasta) {
    hasta.addEventListener("change", function () {
      actualizarCantidadDias();
    });
  }

  if (botonSubmit) {
    botonSubmit.addEventListener("click", function (event) {
      // Validamos que las fechas sean correctas
      if (desde && desde.value < manana) {
        alert("La fecha 'Desde' no puede ser menor a mañana.");
        event.preventDefault();
        return false;
      }

      if (hasta && hasta.value < desde.value) {
        alert("La fecha 'Hasta' no puede ser menor a la fecha 'Desde'.");
        event.preventDefault();
        return false;
      }
    });
  }

  function actualizarCantidadDias() {
    if (desde && hasta && desde.value && hasta.value) {
      var fechaDesde = new Date(desde.value);
      var fechaHasta = new Date(hasta.value);

      if (fechaHasta >= fechaDesde) {
        var diferencia =
          Math.floor((fechaHasta - fechaDesde) / (1000 * 60 * 60 * 24)) + 1;

        if (cantidad) {
          cantidad.value = diferencia;
        }

        if (cantidad_dias) {
          cantidad_dias.value = diferencia;
        }
      } else {
        if (cantidad) {
          cantidad.value = "";
        }

        if (cantidad_dias) {
          cantidad_dias.value = "";
        }
      }
    } else {
      if (cantidad) {
        cantidad.value = "";
      }

      if (cantidad_dias) {
        cantidad_dias.value = "";
      }
    }
  }
});
