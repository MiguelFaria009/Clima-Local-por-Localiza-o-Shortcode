//clima


function clima_local_shortcode() {
    // Pegar o IP do usuário
    $ip = $_SERVER['REMOTE_ADDR'];
    if ($ip == '127.0.0.1') {
        $ip = '8.8.8.8'; // IP de teste para localhost
    }

    // Obter localização via ip-api.com
    $geo_url = "http://ip-api.com/json/{$ip}";
    $geo_response = wp_remote_get($geo_url);
    if (is_wp_error($geo_response)) {
        return 'Erro ao detectar localização: ' . $geo_response->get_error_message();
    }

    $geo_data = json_decode(wp_remote_retrieve_body($geo_response));
    if (!$geo_data || $geo_data->status !== 'success') {
        return 'Localização não encontrada.';
    }

    $cidade = $geo_data->city;
    $lat = $geo_data->lat;
    $lon = $geo_data->lon;

    // Configurar a API do OpenWeatherMap
    $api_key = 'SUA_API_AQUI';
    $weather_url = "https://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lon}&appid={$api_key}&units=metric&lang=pt_br";
    
    $weather_response = wp_remote_get($weather_url);
    if (is_wp_error($weather_response)) {
        return 'Erro ao obter dados climáticos: ' . $weather_response->get_error_message();
    }

    $weather_body = wp_remote_retrieve_body($weather_response);
    $weather_data = json_decode($weather_body);

    // Adicionar depuração
    if (!$weather_data || !isset($weather_data->main)) {
        // Logar a resposta completa para análise
        error_log('Resposta da API OpenWeather: ' . $weather_body);
        return 'Dados climáticos indisponíveis. Verifique o log de erros para detalhes.';
    }

    // Extrair informações
    $temperatura = round($weather_data->main->temp);
    $condicao = strtolower($weather_data->weather[0]->main);

    // Definir ícone condicional
    $icone = '';
    if (stripos($condicao, 'clear') !== false) {
        $icone = '☀️'; // Sol
    } elseif (stripos($condicao, 'rain') !== false || stripos($condicao, 'drizzle') !== false) {
        $icone = '🌧️'; // Chuva
    } elseif (stripos($condicao, 'cloud') !== false) {
        $icone = '☁️'; // Nublado
    } else {
        $icone = '🌦️'; // Genérico
    }

    // Montar o HTML de saída
    $output = "<div class='clima-local'>";
    $output .= "<p>Clima em {$cidade}: {$temperatura}°C {$icone}</p>";
    $output .= "</div>";

    return $output;
}
add_shortcode('clima_local', 'clima_local_shortcode');