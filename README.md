# 🎯 Clima Local para WordPress (via Shortcode)

Este é um shortcode PHP para WordPress que exibe a temperatura e o clima atual da cidade do visitante, detectando automaticamente sua localização através do endereço IP.

O shortcode se conecta às APIs gratuitas **ip-api.com** (para geolocalização) e **OpenWeatherMap** (para clima) e retorna a temperatura atual, uma descrição do clima e um ícone ilustrativo.

---

## 🚀 Como Usar

### 1️⃣ Instalação

1. No painel do WordPress, acesse **Aparência > Editor de tema** ou utilize um plugin como **Code Snippets**.
2. Cole todo o código no arquivo `functions.php` do seu tema filho ou no snippet.
3. Salve.

### 2️⃣ Ativação do Shortcode

Use o shortcode abaixo em qualquer página, post ou widget do Elementor, Gutenberg ou Classic Editor:

```
[clima_local]
```

---

## 🔥 Exemplo de Saída

```
Clima em São Paulo: 26°C ☀️
```

---

## 🔧 Tecnologias Usadas

- 🔹 **[ip-api.com](http://ip-api.com)** — API de Geolocalização baseada em IP.
- 🔹 **[OpenWeatherMap](https://openweathermap.org/)** — API de informações climáticas.

---

## 🗺️ Como Funciona

1. O script captura o IP do visitante (`$_SERVER['REMOTE_ADDR']`).
2. Consulta a API `ip-api.com` para obter latitude, longitude e cidade.
3. Usa as coordenadas geográficas para consultar a API `OpenWeatherMap`.
4. Retorna a temperatura atual, a condição climática e um ícone correspondente.

---

## 🧠 Observações

- Quando testado localmente (IP `127.0.0.1`), ele utiliza um IP fixo (`8.8.8.8`) como fallback para garantir o funcionamento durante o desenvolvimento.
- A chave da API do OpenWeatherMap deve ser configurada corretamente na variável:

```php
$api_key = 'SUA_API_KEY_AQUI';
```

- O script já está configurado para exibir a temperatura em **graus Celsius** e idioma **português (pt_br)**.

---

## 🎨 Personalização

Você pode estilizar o bloco de clima adicionando CSS ao seu tema:

```css
.clima-local {
    background-color: #f5f5f5;
    padding: 10px 15px;
    border-radius: 8px;
    display: inline-block;
    font-family: Arial, sans-serif;
    color: #333;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}
```

---

## ⚠️ Limitações

- A detecção por IP não é 100% precisa em todos os casos (VPN, Proxy, CGNAT).
- As APIs possuem limites de requisições gratuitas. Verifique os termos:

- [ip-api.com - Limites e Políticas](https://ip-api.com/docs/)
- [OpenWeatherMap - Pricing](https://openweathermap.org/price)

---

## 💡 Roadmap de Melhorias (Sugestões)

- [ ] Adicionar cache para reduzir chamadas à API.
- [ ] Mostrar previsão para os próximos dias.
- [ ] Suporte a múltiplos estilos de exibição (via parâmetros no shortcode).

---

## 🤝 Contribuições

Contribuições são bem-vindas!  
Sinta-se à vontade para abrir um issue ou enviar um pull request.

---

## 📜 Licença

Distribuído sob a licença MIT. Consulte o arquivo `LICENSE` para mais informações.

---

## 🚀 Desenvolvido por

**Miguel - [Comércio do Site](https://comerciodosite.com.br)**  
💻 Soluções Web, APIs e Desenvolvimento sob demanda.

---
