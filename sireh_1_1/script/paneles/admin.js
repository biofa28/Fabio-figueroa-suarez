document.addEventListener('DOMContentLoaded', () => {
  const menuItems = document.querySelectorAll('.menu-item');
  const sections = document.querySelectorAll('.section');
  
  const formRegistrarPersonal = document.getElementById('formRegistrarPersonal'); 
  const mensajeDivRegistrar = document.getElementById('mensajeRegistro'); 

  // Referencia al Modal de Bootstrap y su instancia
  const modalEditarUsuarioElement = document.getElementById('modalEditarUsuarioBS');
  const modalEditarUsuario = modalEditarUsuarioElement ? new bootstrap.Modal(modalEditarUsuarioElement) : null;
  
  const formEditarUsuario = document.getElementById('formEditarUsuarioBS'); // ID del form dentro del modal BS
  const mensajeDivEditar = document.getElementById('mensajeEditar'); // Div de mensaje dentro del modal
  const tablaUsuariosBody = document.getElementById('tablaUsuariosBody');

  const rolRegSelect = document.getElementById('rol_reg_select');
  const rolEditSelect = document.getElementById('rol_edit_select');

  const btnIrARegistroPersonalGestion = document.getElementById('btnIrARegistroPersonalEnGestion');

  // --- FUNCIÓN PARA CARGAR ROLES EN LOS SELECTS ---
  function cargarRolesEnSelects(selectElement) {
    if (!selectElement) return Promise.reject("Elemento select no encontrado para roles");
    
    // Evitar recargar si ya tiene opciones (excepto la placeholder)
    if (selectElement.options.length > 1 && selectElement.id === rolEditSelect.id) {
        // Para el modal de edición, solo recargamos si está realmente vacío
        // o si queremos forzar una recarga (podríamos añadir un parámetro para eso)
        // Por ahora, si ya tiene roles, asumimos que están bien.
        // return Promise.resolve(); 
    }
     // Para el select de registro, siempre es bueno limpiar y recargar al mostrar la sección
    if (selectElement.id === rolRegSelect.id) {
        selectElement.innerHTML = '<option value="">Seleccione un rol...</option>';
    }


    return fetch('controlador/UsuarioController.php?accion=listarRoles')
      .then(response => {
        if (!response.ok) throw new Error(`Error HTTP cargando roles: ${response.status}`);
        return response.json();
      })
      .then(data => {
        if (data.success && data.data) {
          // Guardar el valor actual si es el select de edición y ya tiene uno
          const currentValue = selectElement.value;
          if (selectElement.id === rolEditSelect.id && selectElement.options.length > 0) {
             // No limpiar si es el de edición y ya tiene opciones, solo añadir/actualizar si es necesario
          } else {
            selectElement.innerHTML = (selectElement.id === rolRegSelect.id) ? '<option value="">Seleccione un rol...</option>' : '';
          }
          
          data.data.forEach(rol => {
            const option = document.createElement('option');
            option.value = rol.Id_Rol;
            option.textContent = rol.Nom_Rol;
            selectElement.appendChild(option);
          });
          // Restaurar valor si lo había y aún existe
          if (currentValue && Array.from(selectElement.options).some(opt => opt.value === currentValue)) {
            selectElement.value = currentValue;
          }

        } else {
          console.error('Error al cargar roles:', data.message);
          selectElement.innerHTML = `<option value="">Error: ${data.message || 'No se cargaron roles'}</option>`;
        }
        return data;
      })
      .catch(error => {
        console.error('Fetch error para listarRoles:', error);
        selectElement.innerHTML = `<option value="">Error de conexión (roles)</option>`;
        throw error;
      });
  }

  // --- LÓGICA PARA MOSTRAR SECCIONES ---
  function mostrarSeccion(targetId) {
    let seccionEncontrada = false;
    sections.forEach(sec => {
      if (sec.id === targetId) {
        sec.style.display = 'block';
        seccionEncontrada = true;
      } else {
        sec.style.display = 'none';
      }
    });

    if (!seccionEncontrada && sections.length > 0) { // Si no se encontró, mostrar la primera por defecto
        sections[0].style.display = 'block';
        targetId = sections[0].id;
    }
    
    menuItems.forEach(item => {
      item.classList.toggle('active', item.getAttribute('data-section') === targetId);
    });

    if (targetId === 'gestion_usuarios' && tablaUsuariosBody) {
      cargarUsuarios();
    }
    if (targetId === 'registro_personal' && rolRegSelect) { 
      cargarRolesEnSelects(rolRegSelect).catch(err => console.error("Error inicial cargando roles para registro:", err));
    }
  }
  
  const activeMenuItem = document.querySelector('.menu-item.active');
  if (activeMenuItem) {
    mostrarSeccion(activeMenuItem.getAttribute('data-section'));
  } else if (menuItems.length > 0) {
    menuItems[0].classList.add('active');
    mostrarSeccion(menuItems[0].getAttribute('data-section'));
  }

  menuItems.forEach(item => {
    item.addEventListener('click', e => {
      e.preventDefault();
      const target = item.getAttribute('data-section');
      mostrarSeccion(target);
    });
  });

  if(btnIrARegistroPersonalGestion){
    btnIrARegistroPersonalGestion.addEventListener('click', () => {
        mostrarSeccion('registro_personal');
    });
  }
  
  // --- REGISTRO DE NUEVO PERSONAL ---
  if (formRegistrarPersonal) {
    formRegistrarPersonal.addEventListener('submit', e => {
      e.preventDefault();
      if(mensajeDivRegistrar) {
        mensajeDivRegistrar.textContent = '';
        mensajeDivRegistrar.className = 'mt-3 alert'; // Clase base para mensajes
      }
      const formData = new FormData(formRegistrarPersonal);
      formData.append('accion', 'crear');

      fetch('controlador/UsuarioController.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if(mensajeDivRegistrar) {
            mensajeDivRegistrar.textContent = data.message;
            if (data.success) {
              mensajeDivRegistrar.classList.remove('alert-danger');
              mensajeDivRegistrar.classList.add('alert-success');
              formRegistrarPersonal.reset();
              if(rolRegSelect) rolRegSelect.value = ""; 
              // Opcional: redirigir a gestión de usuarios o recargar la lista si está visible
              // mostrarSeccion('gestion_usuarios');
            } else {
              mensajeDivRegistrar.classList.remove('alert-success');
              mensajeDivRegistrar.classList.add('alert-danger');
            }
        }
      })
      .catch((error) => {
        console.error('Error en fetch registrar personal:', error);
        if(mensajeDivRegistrar) {
            mensajeDivRegistrar.textContent = 'Error de conexión al registrar personal.';
            mensajeDivRegistrar.className = 'mt-3 alert alert-danger';
        }
      });
    });
  }

  // --- GESTIÓN DE USUARIOS (Listar, Editar, Eliminar) ---
  function cargarUsuarios() {
    if (!tablaUsuariosBody) return;
    fetch('controlador/UsuarioController.php?accion=listar')
    .then(response => {
        if (!response.ok) {
             return response.json().then(err => { throw new Error(err.message || `Error HTTP ${response.status}` ) });
        }
        return response.json();
    })
    .then(data => {
      tablaUsuariosBody.innerHTML = ''; 
      if (data.success && data.data) {
        if (data.data.length === 0) {
            tablaUsuariosBody.innerHTML = `<tr><td colspan="7" class="text-center">No hay usuarios registrados.</td></tr>`;
        } else {
            data.data.forEach(usuario => {
                const tr = tablaUsuariosBody.insertRow();
                tr.insertCell().textContent = usuario.Nombre_Usuario_Sistema;
                tr.insertCell().textContent = usuario.Nick_Usuario;
                tr.insertCell().textContent = usuario.Correo_Electronico;
                tr.insertCell().textContent = usuario.Nom_Rol;
                tr.insertCell().textContent = usuario.Estado;
                tr.insertCell().textContent = usuario.Fecha_Creacion ? new Date(usuario.Fecha_Creacion).toLocaleDateString() : 'N/A';
                
                const accionesCell = tr.insertCell();
                accionesCell.innerHTML = `
                    <button class="btn btn-sm btn-primary btn-editar" data-id="${usuario.Id_Usuario}"><i class="fas fa-edit"></i> Editar</button>
                    <button class="btn btn-sm btn-danger btn-eliminar" data-id="${usuario.Id_Usuario}"><i class="fas fa-trash"></i> Eliminar</button>
                `; // Usando clases de Bootstrap para botones
            });
        }
      } else {
        tablaUsuariosBody.innerHTML = `<tr><td colspan="7" class="text-center text-danger">Error al cargar usuarios: ${data.message || 'Desconocido'}</td></tr>`;
      }
    })
    .catch(error => {
      console.error('Error en fetch para listar usuarios:', error);
      tablaUsuariosBody.innerHTML = `<tr><td colspan="7" class="text-center text-danger">Error de conexión: ${error.message}</td></tr>`;
    });
  }

  if (tablaUsuariosBody) {
    tablaUsuariosBody.addEventListener('click', async function(e) { // Marcar como async
      const targetButton = e.target.closest('button'); // Para que funcione si se hace clic en el icono dentro del botón
      if (!targetButton) return;

      if (targetButton.classList.contains('btn-editar')) {
        const idUsuario = targetButton.dataset.id;
        await abrirModalEditar(idUsuario); // Esperar a que el modal se prepare
      }
      if (targetButton.classList.contains('btn-eliminar')) {
        const idUsuario = targetButton.dataset.id;
        if (confirm('¿Estás seguro de que deseas eliminar este usuario? Esta acción no se puede deshacer.')) {
          eliminarUsuario(idUsuario);
        }
      }
    });
  }
  
  async function abrirModalEditar(idUsuario) {
    if(mensajeDivEditar) {
        mensajeDivEditar.textContent = '';
        mensajeDivEditar.className = 'mt-3 alert';
    }
    if (!modalEditarUsuario || !rolEditSelect) return;

    try {
        await cargarRolesEnSelects(rolEditSelect); // Asegurar que los roles estén cargados y esperar
        
        const response = await fetch(`controlador/UsuarioController.php?accion=obtenerPorId&id_usuario=${idUsuario}`);
        if (!response.ok) {
            const errData = await response.json().catch(() => ({ message: `Error HTTP ${response.status}`}));
            throw new Error(errData.message);
        }
        const data = await response.json();

        if (data.success && data.data) {
            document.getElementById('id_usuario_edit').value = data.data.Id_Usuario;
            document.getElementById('nombre_edit').value = data.data.Nombre_Usuario_Sistema;
            document.getElementById('nick_edit').value = data.data.Nick_Usuario;
            document.getElementById('correo_edit').value = data.data.Correo_Electronico;
            rolEditSelect.value = data.data.Id_Rol; 
            document.getElementById('estado_edit').value = data.data.Estado;
            document.getElementById('contrasena_edit').value = ''; 
            modalEditarUsuario.show(); // Mostrar modal de Bootstrap
        } else {
            alert('Error al cargar datos del usuario: ' + (data.message || 'Desconocido'));
        }
    } catch (error) {
        console.error('Error al obtener usuario para editar:', error);
        alert(`Error al cargar datos: ${error.message}`);
    }
  }

  if (formEditarUsuario) {
    formEditarUsuario.addEventListener('submit', function(e) {
      e.preventDefault();
      if(mensajeDivEditar) {
        mensajeDivEditar.textContent = '';
        mensajeDivEditar.className = 'mt-3 alert';
      }
      const formData = new FormData(formEditarUsuario);
      formData.append('accion', 'actualizar');

      fetch('controlador/UsuarioController.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if(mensajeDivEditar){
            mensajeDivEditar.textContent = data.message;
            if (data.success) {
              mensajeDivEditar.classList.remove('alert-danger');
              mensajeDivEditar.classList.add('alert-success');
              // Esperar un poco antes de ocultar y recargar para que se vea el mensaje
              setTimeout(() => {
                if(modalEditarUsuario) modalEditarUsuario.hide(); 
                cargarUsuarios(); 
              }, 1500);
            } else {
              mensajeDivEditar.classList.remove('alert-success');
              mensajeDivEditar.classList.add('alert-danger');
            }
        }
      })
      .catch(error => {
        console.error('Error al actualizar usuario:', error);
        if(mensajeDivEditar){
            mensajeDivEditar.textContent = 'Error de conexión al actualizar.';
            mensajeDivEditar.className = 'mt-3 alert alert-danger';
        }
      });
    });
  }

  function eliminarUsuario(idUsuario) {
    const formData = new FormData();
    formData.append('id_usuario', idUsuario);
    formData.append('accion', 'eliminar');

    fetch('controlador/UsuarioController.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        // Usar un toast o notificación de Bootstrap en lugar de alert si es posible
        alert(data.message); 
        cargarUsuarios(); 
      } else {
        alert('Error al eliminar usuario: ' + data.message);
      }
    })
    .catch(error => {
      console.error('Error al eliminar usuario:', error);
      alert('Error de conexión al eliminar usuario.');
    });
  }
});