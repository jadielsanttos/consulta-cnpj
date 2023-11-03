# Buscador de CNPJ
<img src="assets/images/buscacnpj.png">

## Sobre o projeto
Através da API da <a href="https://apiconsultacnpj.com.br/" target="_blank">Speedio</a>, é possível buscar dados de um *CNPJ* específico, como razão social, data de abertura, dentre outros. Com isso em mente, decidi criar um projeto para solucionar um problema que algumas pessoas podem ter, que é a dúvida sobre a procedência de um CNPJ, se ele é verídico, se foi criado recentemente, etc. Sabemos que existem muitos golpes utilizando CPF/CNPJ fake.

## Tecnologias utilizadas
Decidi usar o <a href="https://php.net" target="_blank">PHP</a> para consumir a api, usar um backend nesse caso é muito mais viável e seguro, tendo em vista que se trata de dados sensíveis, com isso, eu tenho mais controle das requisições e deixo aberta a possibilidade de adicionar novas funcionalidades. Utilizei a biblioteca <a href="https://www.php.net/manual/pt_BR/book.curl.php" target="_blank">cURL</a>, para fazer a comunicação com o webservice.

## Observações finais
O uso *inapropriado* dos dados referente aos CNPJ's, está ligado diretamente com a índole do usuário, o projeto foi criado com o intuito de ser uma ferramenta de pesquisa e investigação digital afim de evitar tais tipos de golpes.

## Link do site online
Acesse: [https://buscacnpj.online](https://buscacnpj.online)