<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## 🛒 Lista de Compras Compartilhável

## 📌 Introdução
Em meados de 2021, este projeto nasceu da necessidade de organizar listas de compras de maneira eficiente e colaborativa. Muitas vezes, ao planejar uma compra conjunta com familiares ou minha esposa, era difícil manter tudo sincronizado. Além disso, viagens como temporadas em Pirenópolis, G0, exigiam um planejamento detalhado de quem compraria cada item. Para resolver isso, desenvolvi um aplicativo que **permite a criação e compartilhamento de listas de compras em tempo real**, tornando todo o processo mais prático e transparente.

## 🛠️ Tecnologias Utilizadas
- **Backend:** Laravel (https://laravel.com/docs/8.x) + PostgreSQL
- **Frontend:** React Native + TypeScript
- **Contêinerização:** Docker para facilitar a configuração e execução do ambiente
- **Comunicação em Tempo Real:** WebSocket para manter as listas sincronizadas entre os usuários

## 🚀 Funcionalidades
- **Criação de listas de compras** personalizadas.
- **Cálculo automático** do valor de cada item.
- **Compartilhamento em tempo real** com outras pessoas.
- **Gerenciamento colaborativo**, permitindo que várias pessoas editem a mesma lista simultaneamente.
- **Ambiente isolado** via Docker, garantindo replicação confiável.
- **Sincronização instantânea** via WebSocket, sem a necessidade de atualizações manuais.

## 🔧 Como Usar
### Configuração com Docker
1. Clone o repositório:
```sh
   git clone https://github.com/seu-usuario/listashop-api.git
   cd listashop-api
```
2. Execute o projeto
```sh
  docker-compose up -d
```

3. Dentro do container, execute:
```sh
  composer install
```

## 💡 Motivação
A principal motivação foi eliminar os desafios de comunicação e organização ao fazer compras conjuntas. Com este aplicativo, qualquer grupo pode criar e gerenciar listas de compras sem confusão ou desencontros.

## 🤝 Contribuições
Sugestões de melhorias e novas funcionalidades são sempre bem-vindas! Fique à vontade para abrir issues e enviar pull requests.
