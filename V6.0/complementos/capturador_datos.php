<script>
        window.onload = function() {
            // Obtener todas las filas de la tabla
            const filasTabla = document.querySelectorAll("#tabladatos tbody tr");
           

            // Agregar un evento 'click' a cada fila
            filasTabla.forEach(fila => {
                fila.addEventListener("click", function() {
                    // Obtener los datos de la fila seleccionada
                    
                    const fechaentrega = this.cells[1].innerText;
                    const fechaentregaac = this.cells[2].innerText;
                    const comen = this.cells[5].innerText;
                    const hostname = this.cells[6].innerText;
                    const serie = this.cells[7].innerText;
                    const cod_inven = this.cells[10].innerText;
                    const fechacompra = this.cells[11].innerText;
                    const facturacompra = this.cells[12].innerText;
                    
                    

                    // Mostrar los datos en los campos de entrada de texto
                    

                    document.getElementById("serie").value = serie;
                    document.getElementById("nombre").value = hostname;
                    document.getElementById("fecha_entrega_equipo").value = fechaentrega;
                    document.getElementById("fecha_firma_ac_entrega").value = fechaentregaac;
                    document.getElementById("comentarios").value = comen;
                    document.getElementById("nombre").value = hostname;
                    document.getElementById("cod_inventario").value = cod_inven;
                    document.getElementById("fecha_compra").value = fechacompra;
                    document.getElementById("factura_compra").value = facturacompra;
                    


                    

                });
            });
        };


            document.addEventListener("DOMContentLoaded", function() {
            const filasTabla = document.querySelectorAll("#tabladatos tbody tr");
            const tipo_acta = document.getElementById("tipo_acta");
            const estado_acta = document.getElementById("estado_acta");
            const memoria_ram = document.getElementById("memoria_ram");
            const disco = document.getElementById("disco");
            const proveedor = document.getElementById("proveedor");
            const piso_ = document.getElementById("piso");
            const tipo_equipo = document.getElementById("tipo_equipo");
            const marca = document.getElementById("marca");
            const modelo = document.getElementById("modelo");
            const jefatura = document.getElementById("jefatura");
            const puesto = document.getElementById("puesto");
            const ubicacion_fisica = document.getElementById("ubicacion_fisica");
            const usuario_responsable = document.getElementById("usuario_responsable");
            const usuario_anterior = document.getElementById("usuario_anterior");
            const estado_equipo = document.getElementById("estado_equipo");
            const delegacion = document.getElementById("delegacion");
            const sede = document.getElementById("sede");
            const gerencia = document.getElementById("gerencia");
            const subgerencia = document.getElementById("subgerencia");
            

            filasTabla.forEach(fila => {
                fila.addEventListener("click", function() {
                    const tip_acta = this.cells[0].innerText;
                    const es_acta = this.cells[4].innerText;
                    const disc = this.cells[8].innerText;
                    const me_ram = this.cells[9].innerText;
                    const prove = this.cells[13].innerText;
                    const piso = this.cells[14].innerText;
                    const tipoequi = this.cells[15].innerText;
                    const marc = this.cells[16].innerText;
                    const model = this.cells[17].innerText;
                    const jefa = this.cells[18].innerText;
                    const pues = this.cells[19].innerText;
                    const ubi_fisi = this.cells[20].innerText;
                    const usr_respon = this.cells[21].innerText;
                    const usr_ante = this.cells[22].innerText;
                    const est_equip = this.cells[23].innerText;
                    const del = this.cells[24].innerText;
                    const sed = this.cells[25].innerText;
                    const gere = this.cells[26].innerText;
                    const subgere = this.cells[27].innerText;
                    

                    
                    for (let i = 0; i < tipo_acta.options.length; i++) {
                        if (tipo_acta.options[i].text === tip_acta) {
                            tipo_acta.value = tipo_acta.options[i].value;
                            break;
                        }
                    }

                    for (let i = 0; i < disco.options.length; i++) {
                        if (disco.options[i].text === disc) {
                            disco.value = disco.options[i].value;
                            break;
                        }
                    }

                    for (let i = 0; i < memoria_ram.options.length; i++) {
                        if (memoria_ram.options[i].text === me_ram) {
                            memoria_ram.value = memoria_ram.options[i].value;
                            break;
                        }
                    }

                    for (let i = 0; i < proveedor.options.length; i++) {
                        if (proveedor.options[i].text === prove) {
                            proveedor.value = proveedor.options[i].value;
                            break;
                        }
                    }
                    
                    for (let i = 0; i < piso_.options.length; i++) {
                        if (piso_.options[i].text === piso) {
                            piso_.value = piso_.options[i].value;
                            break;
                        }
                    }

                    for (let i = 0; i < tipo_equipo.options.length; i++) {
                        if (tipo_equipo.options[i].text === tipoequi) {
                            tipo_equipo.value = tipo_equipo.options[i].value;
                            break;
                        }
                    }

                    for (let i = 0; i < marca.options.length; i++) {
                        if (marca.options[i].text === marc) {
                            marca.value = marca.options[i].value;
                            break;
                        }
                    }
                   
                    for (let i = 0; i < modelo.options.length; i++) {
                        if (modelo.options[i].text === model) {
                            modelo.value = modelo.options[i].value;
                            break;
                        }
                    }

                    for (let i = 0; i < jefatura.options.length; i++) {
                        if (jefatura.options[i].text === jefa) {
                            jefatura.value = jefatura.options[i].value;
                            break;
                        }
                    }

                    for (let i = 0; i < puesto.options.length; i++) {
                        if (puesto.options[i].text === pues) {
                            puesto.value = puesto.options[i].value;
                            break;
                        }
                    }

                    for (let i = 0; i < ubicacion_fisica.options.length; i++) {
                        if (ubicacion_fisica.options[i].text === ubi_fisi) {
                            ubicacion_fisica.value = ubicacion_fisica.options[i].value;
                            break;
                        }
                    }

                    for (let i = 0; i < usuario_responsable.options.length; i++) {
                        if (usuario_responsable.options[i].text === usr_respon) {
                            usuario_responsable.value = usuario_responsable.options[i].value;
                            break;
                        }
                    }

                    for (let i = 0; i < usuario_anterior.options.length; i++) {
                        if (usuario_anterior.options[i].text === usr_ante) {
                            usuario_anterior.value = usuario_anterior.options[i].value;
                            break;
                        }
                    }
                    
                    for (let i = 0; i < estado_equipo.options.length; i++) {
                        if (estado_equipo.options[i].text === est_equip) {
                            estado_equipo.value = estado_equipo.options[i].value;
                            break;
                        }
                    }

                    for (let i = 0; i < sede.options.length; i++) {
                        if (sede.options[i].text === sed) {
                            sede.value = sede.options[i].value;
                            break;
                        }
                    }

                    for (let i = 0; i < delegacion.options.length; i++) {
                        if (delegacion.options[i].text === del) {
                            delegacion.value = delegacion.options[i].value;
                            break;
                        }
                    }

                    for (let i = 0; i < gerencia.options.length; i++) {
                        if (gerencia.options[i].text === gere) {
                            gerencia.value = gerencia.options[i].value;
                            break;
                        }
                    }

                    for (let i = 0; i < subgerencia.options.length; i++) {
                        if (subgerencia.options[i].text === subgere) {
                            subgerencia.value = subgerencia.options[i].value;
                            break;
                        }
                    }

                    for (let i = 0; i < estado_acta.options.length; i++) {
                        if (estado_acta.options[i].text === es_acta) {
                            estado_acta.value = estado_acta.options[i].value;
                            break;
                        }
                    }
                });
            });
        });

    </script>