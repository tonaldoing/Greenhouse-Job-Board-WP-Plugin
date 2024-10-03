<?php

// Function to fetch jobs and return as HTML
function greenhouse_get_jobs_list($atts = array()) { // Asegurar que $atts sea opcional
    // Extraer el parámetro de estilo desde los atributos del shortcode
    $atts = shortcode_atts( array(
        'style_mode' => 'light', // Valor por defecto: light
    ), $atts );

    // Definir el color de fuente basado en el estilo seleccionado
    $font_color = $atts['style_mode'] === 'dark' ? '#ffffff' : '#000000'; // Blanco para dark, negro para light

    $show_search = get_option('greenhouse_show_search', 'yes');
    $board_token = get_option('greenhouse_board_token');

    // Verificar si el caché existe y el token es correcto
    $cached_board_token = get_transient('greenhouse_board_token');
    
    // Si el token cambió o el caché expiró, limpiamos el caché
    if ($cached_board_token !== $board_token) {
        delete_transient('greenhouse_jobs');
        set_transient('greenhouse_board_token', $board_token, HOUR_IN_SECONDS);
        $cached_jobs = false;
    } else {
        $cached_jobs = get_transient('greenhouse_jobs');
    }

    if (false === $cached_jobs) {
        // Realizamos la llamada a la API
        $response = wp_remote_get("https://boards-api.greenhouse.io/v1/boards/$board_token/jobs?content=true");
        if (is_wp_error($response)) {
            return '<p style="color:red;">Error: Unable to connect to Greenhouse. Please try again later.</p>';
        }
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);
        if (empty($data['jobs'])) {
            return '<p>No jobs available at the moment.</p>';
        }

        // Guardamos los trabajos en el caché con el nuevo token
        set_transient('greenhouse_jobs', $data['jobs'], HOUR_IN_SECONDS);
        $cached_jobs = $data['jobs'];
    }

    // Agrupar trabajos por departamento
    $jobs_by_department = [];
    foreach ($cached_jobs as $job) {
        // Verificar si existe un departamento, usar "Other" si no está disponible
        $department_name = isset($job['departments'][0]['name']) ? $job['departments'][0]['name'] : 'Other';
        $jobs_by_department[$department_name][] = $job;
    }

    // Contar trabajos
    $total_jobs = count($cached_jobs);

    // Iniciar la construcción del output
    $output = "<style>
        .job-post .body,
        .section-header {
            color: {$font_color};
        }
    </style>";

    $output .= "<p class='total-jobs'>Total Jobs: <span id='job-count'>$total_jobs</span></p>";

    // Añadir barra de búsqueda si está habilitada
    if ($show_search === 'yes') {
        $output .= '<input type="text" id="job-search" placeholder="Search jobs..." />';
    }

    // Mostrar trabajos agrupados por departamento
    foreach ($jobs_by_department as $department_name => $jobs) {
        if (count($jobs) > 0) {  // Mostrar sección solo si hay trabajos
            $output .= '<div class="job-posts" data-department="' . esc_attr($department_name) . '">';
            $output .= "<h3 class='section-header font-primary'>$department_name</h3>";
            $output .= '<div class="job-posts--list">'; // Iniciar el contenedor de la lista de trabajos

            foreach ($jobs as $job) {
                $output .= '<div class="job-post">';
                $output .= '<div class="cell">';
                $output .= '<a href="' . esc_url($job['absolute_url']) . '" target="_blank">';
                $output .= '<p class="body body--medium job-title">' . esc_html($job['title']) . '</p>';
                $output .= '<p class="body body__secondary body--metadata job-location">' . esc_html($job['location']['name']) . '</p>';
                $output .= '</a>';
                $output .= '</div>';
                $output .= '</div>';
            }

            $output .= '</div>'; // Cerrar el contenedor de la lista de trabajos
            $output .= '</div>'; // Cerrar job-posts
        }
    }

    // Añadir funcionalidad de búsqueda dinámica
    $output .= '<script>
    document.getElementById("job-search").addEventListener("input", function() {
        var searchValue = this.value.toLowerCase();
        var total = 0;

        document.querySelectorAll(".job-posts").forEach(function(section) {
            var hasVisibleJobs = false;

            section.querySelectorAll(".job-post").forEach(function(job) {
                if (job.textContent.toLowerCase().includes(searchValue)) {
                    job.style.display = "block";
                    hasVisibleJobs = true;
                    total++;
                } else {
                    job.style.display = "none";
                }
            });

            // Alternar la visibilidad de la sección según los resultados de búsqueda
            if (hasVisibleJobs) {
                section.style.display = "block";
            } else {
                section.style.display = "none";
            }
        });

        // Actualizar el conteo de trabajos dinámicamente
        document.getElementById("job-count").innerText = total;
    });
    </script>';

    return $output;
}
